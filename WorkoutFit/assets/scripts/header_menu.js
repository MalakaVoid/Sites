$(document).ready(function(){
    $(".menu-btn").click(function(){
        $("#mobile-menu").fadeIn(400);
        $(".menu-close-btn").show();
        $(".menu-btn").hide();
        $("body").css("overflow-y", "hidden");
        $("#header").hide();
        $("#header").removeClass("scrolled");
        $("#header").fadeIn(300);

    });
    $(".menu-close-btn").click(function(){
        $("#mobile-menu").fadeOut(400);
        $(".menu-close-btn").hide();
        $(".menu-btn").show();
        $("body").css("overflow-y", "unset");
        scroll_class();
    });

    $(window).scroll(scroll_class);

    function scroll_class(){
        if ($(this).scrollTop() == 0){
            $("#header").removeClass("scrolled");
        } else{
            $("#header").addClass("scrolled");
        }
    }
});

