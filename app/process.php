<?php

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

echo "Done.";

// require_once 'google-api-php-client/src/Google_Client.php';
// require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

// // client_id, client_secret, redirect_uri, refresh_token
// $stored = json_decode(file_get_contents('auth.json'));

// $client = new Google_Client();

// $client->setClientId($stored->client_id);
// $client->setClientSecret($stored->client_secret);
// $client->setRedirectUri($stored->redirect_uri);
// $client->setScopes(array('https://www.googleapis.com/auth/drive'));
// $client->refreshToken($stored->refresh_token);

// $service = new Google_DriveService($client);

?>