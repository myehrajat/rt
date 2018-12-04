// Content Contact Form
// ---------------------------------------------------------------------------------------
jQuery(document).ready(function ($) {
    $("#contact-form .form-control").tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    $('#contact-form .form-control').blur(function () {
        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    });

    $("#contact-form #submit_btn").click(function () {
        // validate and process form
        // first hide any error messages
        var thisbtn = $(this);

        thisbtn.prop('disabled', true);
        $('#contact-form .error').hide();

        var name = $("#contact-form input#name").val();
        if (name == "" || name == "Name..." || name == "Name" || name == "Name *" || name == "Type Your Name...") {
            $("#contact-form input#name").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            $("#contact-form input#name").focus();
            thisbtn.prop('disabled', false);
            return false;
        }
        var email = $("#contact-form input#email").val();
        var filter =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        //console.log(filter.test(email));
        if (!filter.test(email)) {
            $("#contact-form input#email").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            $("#contact-form input#email").focus();
            thisbtn.prop('disabled', false);
            return false;
        }
        if( $('input').is('#subject')) {
            var subject = $("#contact-form input#subject").val();
            if (subject == "" || subject == "Subject") {
                $("#contact-form input#subject").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
                $("#contact-form input#subject").focus();
                thisbtn.prop('disabled', false);
                return false;
            }
        }
        var message = $("#contact-form #input-message").val();
        if (message == "" || message == "Message..." || message == "Message" || message == "Message *" || message == "Type Your Message...") {
            $("#contact-form #input-message").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            $("#contact-form #input-message").focus();
            thisbtn.prop('disabled', false);
            return false;
        }

        var dataString = 'action=rentit_ajax_sent_mail&name=' + name + '&email=' + email + '&subject=' + subject + '&message=' + message;
        //alert (dataString);return false;

        $.ajax({
            type: "POST",
            url: rentit_obj.ajaxurl,
            data: dataString,
            success: function (data) {

                var html = "<div class=\"alert alert-success fade in\">" +
                    "<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button>"
                    +"" + data + "" +
                    "</div>";

                $('#contact-form').append(html);
                $('#contact-form')[0].reset();
                thisbtn.prop('disabled', false);
            }
        });
        return false;
    });
});

// Subscribe Form
// ---------------------------------------------------------------------------------------
jQuery(document).ready(function ($) {
    $(".form-subscribe .form-control").tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    $('.form-subscribe .form-control').blur(function () {
        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    });

    $(".form-subscribe .btn-submit").click(function () {
        // validate and process form
        // first hide any error messages
        var  this_btn =  $(this);
        $('.form-subscribe .error').hide();
        this_btn.prop('disabled', true);

        var email = $(".form-subscribe input#formSubscribeEmail").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        //console.log(filter.test(email));
        if (!filter.test(email)) {
            this_btn.prop('disabled', false);
            $(".form-subscribe input#formSubscribeEmail").tooltip({
                placement: 'bottom',
                trigger: 'manual'
            }).tooltip('show');
            $(".form-subscribe input#formSubscribeEmail").focus();
            jQuery('.form-subscribe .btn-submit').prop('disabled', false);
            return false;
        }

        var dataString = 'action=rentit_mailchimp_send&email=' + email + '';
        //alert (dataString);return false;
//Email Submitted!
            $.ajax({
            type: "POST",
            url: rentit_obj.ajaxurl,
            data: dataString,
            success: function (date) {
                jQuery('.form-subscribe .btn-submit').prop('disabled', false);
                $('.form-subscribe').append("<div class=\"alert alert-success fade in\">" +
                    "<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>" +
                   ""+ date +""+
                    "</strong></div>");
                $('.form-subscribe')[0].reset();

            }
        });
        return false;
    });
});