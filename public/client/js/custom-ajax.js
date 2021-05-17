$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    // ajax để làm form đăng ký nhận thông tin
    $("form#frm-email").submit(function(e) {
        e.preventDefault();
    });
    $("button#btn-email").click(function(e) {
        var email = $("#emailSubscription").val();
        if(email != ''){
            $.ajax({
                type: "POST",
                url: "/subscribeEmail",
                data: {
                    email: email
                },
                dataType: "json",
                success: function(response) {
                    alert(response.msg);
                    $("#emailSubscription").val("");
                }
            });
        }else{
            alert('Vui lòng không để trống trường email');
        }
    });
    //end-------------------------------------
    $("form#frm-email").submit(function(e) {
        e.preventDefault();
    });
    $("button#btn-contact").click(function(e) {
        var name = $('input[name="name"]').val();
        var email = $('input[name="email"]').val();
        var subject = $('input[name="subject"]').val();
        var message = $('textarea[name="message"]').val();
        var is_received_news = 0;
        if($('input[name="is_received_news"]').prop('checked') == true){
            is_received_news = 1;
        }
        if(name == '' || email == '' || subject == '' || message == ''){
            alert('Vui lòng không để trống');
        }else{
            $.ajax({
                type: "POST",
                url: "/storeContact",
                data: {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message,
                    is_received_news: is_received_news
                },

                dataType: "json",
                success: function(response) {
                    $('div#div-message').html(response.msg).removeClass('d-none').addClass(response.class);
                    $('input[name="name"]').val('');
                    $('input[name="email"]').val('');
                    $('input[name="subject"]').val('');
                    $('textarea[name="message"]').val('');
                    $('input[name="is_received_news"]').prop('checked', false);
                },
                error: function(error){
                    console.log(error);
                }

            });
        }
    });

    //search
    $("form#frmSearch").submit(function(e) {
        e.preventDefault();
    });
    $("button#btnSearch").click(function(e) {
        var search_key = $('input[name="search_key"]').val();
     
        
        if(search_key == ''){
            $('div#suggest-result').html('Vui lòng không để trống').removeClass('d-none').addClass('alert alert-danger');
        }else{
            $.ajax({
                type: "POST",
                url: "/search",
                data: {
                    search_key: search_key,
                },

                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('div#suggest-result').html(response.data).removeClass('d-none').addClass('alert alert-success');
                },
                error: function(error){
                    console.log(error);
                }

            });
        }
    });

});
