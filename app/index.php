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
            <form name="contact" action="">
                <div>
                    <label for="name" id="name_label">Name</label>
                    <input type="text" name="name" id="name" size="30" value="" class="text-input" />
                </div>    
                <div>
                    <label for="email" id="email_label">Email</label>
                    <input type="text" name="email" id="email" size="30" value="" class="text-input" />
                </div>    
                <div>
                    <label for="phone" id="phone_label">Phone</label>
                    <input type="text" name="phone" id="phone" size="30" value="" class="text-input" />
                </div>
                <div>    
                    <input type="submit" name="submit" class="button" id="submit_btn" value="Send" formaction="process.php"/>
                </div>    
            </form>
        </div> 

        <script src="bower_components/jquery/jquery.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>