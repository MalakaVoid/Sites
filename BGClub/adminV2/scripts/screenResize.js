$(window).ready(function() {

    let windowWidth = $(window).width();
    let tableWidth = $('.table_items').width();
    let messageWidth = windowWidth - tableWidth - 60 - 20;
    $('.messages').width(messageWidth);

    $(window).on('resize', function() {
        let windowWidth = $(window).width();
        let tableWidth = $('.table_items').width();
        let messageWidth = windowWidth - tableWidth - 60 - 20;
        $('.messages').width(messageWidth);
    });

});