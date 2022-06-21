$(document).ready(function() {
    $('#form_company').submit(function(e) {
        var $form = $(this);
        let token = $('#api_token').val();
        console.log(token);
        $.ajax({
            type: 'get',
            url: $form.attr('action'),
            headers: {
                'Authorization':'Bearer ' + token,
                'Content-Type':'application/json'
            },
        }).done(function(response) {
            console.log(response);
            $('#companies').css('display', 'inline');
            if (response.data){
                $.each(response.data, function (index, val){
                    console.log(val.company.title);
                    $('#companies-list').append("<li class='list-group-item'>" + val.company.title +  "</li>");
                });
            }
        }).fail(function(error) {
            $('#errors').css("display", "inline");
            $('#error').text('');
            if (error.responseJSON.status == "error")
            {
                $('#error-list').append("<li>" + error.responseJSON.info +  "</li>");
            }
        });
        e.preventDefault();
    });
});
