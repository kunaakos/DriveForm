<?php
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

print "\nPlease enter JSON filename:\n>";
$clientFileName = trim(fgets(STDIN));

$stored = json_decode(file_get_contents($clientFileName));

print "\n";

$client = new Google_Client();

$client->setClientId($stored->installed->client_id);
$client->setClientSecret($stored->installed->client_secret);
$client->setRedirectUri($stored->installed->redirect_uris[0]);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));

$service = new Google_DriveService($client);

$authUrl = $client->createAuthUrl();

//Request authorization
print "Please visit:\n$authUrl\n\n";
print "Please enter the auth code:\n";
$authCode = trim(fgets(STDIN));

// Exchange authorization code for access token
$accessToken = $client->authenticate($authCode);
$tokenObject = json_decode($accessToken);

// Print some stuff
print "\n";
print "Client ID: " . $stored->installed->client_id . "\n";
print "Secret: " . $stored->installed->client_secret . "\n";
print "Redirect URI: " . $stored->installed->redirect_uris[0] . "\n";
print "Refresh Token: " . $tokenObject->refresh_token . "\n";

// Gather data for saving
$toSave = (object) 
    array(
        'client_id' => $stored->installed->client_id,
        'client_secret' => $stored->installed->client_secret,
        'redirect_uri' => $stored->installed->redirect_uris[0],
        'refresh_token' => $tokenObject->refresh_token
    );

// JSON encode and print 
$saveString = json_encode($toSave);

print "\nCopy and paste this in auth.json if writing to file fails:\n";
print "\n" . $saveString . "\n";
print "\n ...saving.";

$saveFile = "auth.json";
$fh = fopen($saveFile, 'w') or die("can't open file");
fwrite($fh, json_encode($toSave));
fclose($fh);

print " OK\n\n";
?>