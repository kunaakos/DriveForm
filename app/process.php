<?php
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

// get POST data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// get client_id, client_secret, redirect_uri, refresh_token
$stored = json_decode(file_get_contents('auth.json'));

// AUTH!
$client = new Google_Client();
$client->setClientId($stored->client_id);
$client->setClientSecret($stored->client_secret);
$client->setRedirectUri($stored->redirect_uri);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
$client->setUseObjects(true);
$client->refreshToken($stored->refresh_token);

// connect to Drive
$service = new Google_DriveService($client);

// generate file contents
$data  = "Name: " . $name . "\n";
$data .= "Email: " . $email . "\n";
$data .= "Phone: " . $phone;

// create files
try {
    // parent folder
    $folder = new Google_DriveFile();
    $folder->setTitle($name . " @ " . date('d M Y H:i:s'));
    $folder->setMimeType('application/vnd.google-apps.folder');
    $parentFolder = $service->files->insert(
        $folder,
        array(
            'mimeType' => 'application/vnd.google-apps.folder'
        )
    );

    // parent reference
    $newParent = new Google_ParentReference();
    $newParent->setId($parentFolder->getId());

    // file
    $file = new Google_DriveFile();
    $file->setParents(array($newParent));
    $file->setTitle("submitted data");
    $file->setDescription("test");
    $file->setMimeType('text/plain');
    $createdFile = $service->files->insert(
        $file, 
        array(
            'data' => $data,
            'mimeType' => 'text/plain',
        )
    );

    // grab a coffee
    echo "Done.";

} catch (Exception $ex) {

    // oopsie!
    echo "Error.";

}

?>