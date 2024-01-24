$(".read-more").click(function(){
    $(this).hide();
    let el = $(".more-info");
    curHeight = el.height();
    autoHeight = el.css('height', 'auto').height();
    el.height(curHeight).animate({height: autoHeight}, 500, function(){
        $(this)
        .find(".front-hide")
        .hide();
    });
});

$(".read-more-2").click(function(){
    $(this).hide();
    let el = $(".instructions-text");
    curHeight = el.height();
    autoHeight = el.css('height', 'auto').height();
    el.height(curHeight).animate({height: autoHeight}, 500, function(){
        $(this)
        .find(".front-hide")
        .hide();
    });
});