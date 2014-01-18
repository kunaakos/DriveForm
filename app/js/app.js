$(function() {
    $('form').submit(function (e) {
        e.preventDefault();
        
        var dataString = "";

        console.log( $('.formdata'));
        $('.formdata').each(function(index){
            dataString += '&' + index + '=';
            dataString += encodeURIComponent($(this).children('input').val());
        });

        console.log(dataString);

        $.ajax({
            type: "POST",
            url: "process.php",
            data: dataString,
            success: function(data) {
                    $('#contact_form').html(data);
            },
            error: function() {
                alert("oopsie!");
            }
        });

    });  
});
  