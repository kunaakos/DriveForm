<?php

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$data = $email . "\n" . $phone;

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

// get client_id, client_secret, redirect_uri, refresh_token
$stored = json_decode(file_get_contents('auth.json'));

// AUTH!
$client = new Google_Client();
$client->setClientId($stored->client_id);
$client->setClientSecret($stored->client_secret);
$client->setRedirectUri($stored->redirect_uri);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
$client->refreshToken($stored->refresh_token);

// connect to Drive
$service = new Google_DriveService($client);

// upload
try {
    $file = new Google_DriveFile();
    $file->setTitle($name);
    $file->setDescription("test");
    $file->setMimeType('text/plain');
    $createdFile = $service->files->insert(
        $file, 
        array(
            'data' => $data,
            'mimeType' => 'text/plain',
        )
    );

    echo "Done.";  

} catch (Exception $ex) {

    echo "Error.";

}

?>