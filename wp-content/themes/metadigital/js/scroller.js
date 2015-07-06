/**
 * Created by LexX on 01.07.2015.
 */
$("document").ready(function () {
    $('.to-main').click(function () {
        $('html, body').animate({
            scrollTop: $("#main").offset().top
        }, 1000);
    });

    $('.to-articles').click(function () {
        $('html, body').animate({
            scrollTop: $("#articles").offset().top
        }, 1000);
    });

    $('.to-gallery').click(function () {
        $('html, body').animate({
            scrollTop: $("#gallery").offset().top
        }, 1000);
    });

    $('.to-main-footer').click(function () {
        $('html, body').animate({
            scrollTop: $("#contact_us").offset().top
        }, 1000);
    });

    $('.contact-us-send-button').click(function() {
        //if ($('.alert-overlay .alert-message').find('.message-success').length) {
        //    $('.alert-overlay .alert-message').css("background-image", "url(\"./wp-content/themes/metadigital/images/success-icon.png\")");
        //}
        //else {
        //    $('.alert-overlay .alert-message').css("background-image", "url(\"./wp-content/themes/metadigital/images/error-icon.png\")");
        //}
    });
});