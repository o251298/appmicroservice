$(document).ready(function() {
   // register scripts
    $('.auth').submit(function(e) {
        var $form = $(this);
        $('#error-list').empty();
        $('#errors').css("display", "none");
        console.log($form);
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize()
        }).done(function(response) {
            console.log(response);
            $('#success').css("display", "inline");
            $('#token').text('');
            $('#token').append(response.info.api_token);
        }).fail(function(error) {
            $('#errors').css("display", "inline");
            $('#error').text('');
            console.log(error);
            if (error.responseJSON.errors){
                $.each(error.responseJSON.errors, function (index, val){
                    $('#error-list').append("<li>" + val +  "</li>");
                });
            }
            if (error.responseJSON.status == "error")
            {
                $('#error-list').append("<li>" + error.responseJSON.info +  "</li>");
            }
        });
        e.preventDefault();
    });
});
