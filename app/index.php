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

        <div id="contact_form">
            <form>

<?php
$inputs = json_decode(file_get_contents('form.json'));
// echo json_encode($inputs);

// generate input fields
foreach ($inputs as $key => $input) {
    $divID = "formdata" . $key;
    $label = $input->label;
    $placeholder = " ";

    echo "<div id=\"" . $divID . "\" class=\"formdata\">\n";
    echo "  <label>" . $label . "</label>\n";
    echo "  <input type=\"text\" placeholder=\"" . $placeholder . "\"/>\n";
    echo "</div>\n";
}
?>               <div>    
                    <input type="submit" value="Send" formaction="process.php"/>
                </div>    
            </form>
        </div> 

        <script src="bower_components/jquery/jquery.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>