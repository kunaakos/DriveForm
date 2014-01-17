<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DriveForm</title>
        <meta name="description" content="A simple PHP form that submits data (and saves uploaded files) to Google Drive.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>


        <script src="bower_components/jquery/jquery.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>

<?php

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