<?php

// $start_time = microtime(TRUE);

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

// // echo POST data
// foreach ($_POST as $key => $value) {
//     echo $key . "= " . $value . "\n";
// }

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

// generate file content
$data = "";
$fileName = "N/A";

$inputs = json_decode(file_get_contents('form.json'));

foreach ($_POST as $key => $value) {
    $data .= $inputs[$key]->label . ": " . $value . "\n";   
    if (isset($inputs[$key]->fileName)) {
        $fileName = $value; 
    }
}

// filename stamp
$fileName .= " @ " . date('d M Y H:i:s');

// create files
try {
    // parent folder
    $folder = new Google_DriveFile();
    $folder->setTitle($fileName);
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

// $end_time = microtime(TRUE);
// echo $end_time - $start_time;

?>