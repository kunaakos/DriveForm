$(function() {
    $('form').submit(function (e) {
        e.preventDefault();
        
        var name = $("input#name").val();
        var email = $("input#email").val();
        var phone = $("input#phone").val();
        var dataString = 'name='+ name + '&email=' + email + '&phone=' + phone;
        
        $.ajax({
            type: "POST",
            url: "process.php",
            data: dataString,
            success: function(data) {
                    $('#contact_form').html("<h2>" + data + "</h2>");
            },
            error: function() {
                alert("oopsie!");
            }
        });

    });  
});
  