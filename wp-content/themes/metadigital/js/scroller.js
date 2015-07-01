/**
 * Created by LexX on 01.07.2015.
 */
$("document").ready(function () {
    $('.to-main').click(function () {
        $('html, body').animate({
            scrollTop: $("#main").offset().top
        }, 2000);
    });

    $('.to-articles').click(function () {
        $('html, body').animate({
            scrollTop: $("#articles").offset().top
        }, 2000);
    });

    $('.to-gallery').click(function () {
        $('html, body').animate({
            scrollTop: $("#gallery").offset().top
        }, 2000);
    });

    $('.to-main-footer').click(function () {
        $('html, body').animate({
            scrollTop: $("#main-footer").offset().top
        }, 2000);
    });
});