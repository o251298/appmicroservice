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
    $('.create-company').submit(function(e) {
        // var $form = $(this);
        // let token = $('#token_test').val();
        // console.log(token);
        // $('#error-list').empty();
        // $('#errors').css("display", "none");
        // console.log($form);
        // $.ajax({
        //     type: $form.attr('method'),
        //     url: $form.attr('action'),
        //     headers: {
        //         'Authorization':'Bearer ' + token,
        //         'Content-Type':'application/json',
        //         "Accept": "application/json; odata=verbose"
        //     },
        //     dataType: 'json',
        //     data: $form.serialize()
        // }).done(function(response) {
        //     console.log(response);
        // }).fail(function(error) {
        //     console.log(error);
        // });
        var $form = $(this);
        let token = $('#token_test').val();
        var formData = {
            title: $("#title_create").val(),
            description: $("#description_create").val(),
            phone: $("#phone_create").val(),
        };
        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            headers: {
                'Authorization':'Bearer ' + token,
                'Content-Type':'application/json'
            },
            data: JSON.stringify(formData),
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
        }).fail(function(error) {
                console.log(error);
        });
        e.preventDefault();
    });
});
