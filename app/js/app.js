$(function() {
    var dataString = "";
    // var formData = new FormData();


    $('form').submit(function (e) {
        e.preventDefault();
        formData = new FormData($('form')[0]);
        console.log($('form')[0]);

        $('.formdata').each(function(index){
            var inputField = $(this).children('input');
            
            if (inputField.attr('type') == 'file') {
                formData.append("files[]", inputField[0].files[0]);
                console.log(inputField[0].files[0]);
            }
            else {
                dataString += '&' + index + '=';
                dataString += encodeURIComponent(inputField.val());
            }
        
        });

        $.ajax({
            type: "POST",
            url: "process.php",
            data: formData,
            processData: false,  
            contentType: false,
            success: function(data) {
                    $('#feedback').html(data);
            },
            error: function() {
                alert("oopsie!");
            }
        });

    });  
});
  