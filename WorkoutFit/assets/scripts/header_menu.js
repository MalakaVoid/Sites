$(document).ready(function(){
    $(".menu-btn").click(function(){
        $("#mobile-menu").fadeIn(400)
        $("#header").css("position", "fixed")
        $(".menu-close-btn").show()
        $(".menu-btn").hide()
        $("body").css("overflow-y", "hidden")
    });
    $(".menu-close-btn").click(function(){
        $("#mobile-menu").fadeOut(400);
        $("#header").css("position", "absolute")
        $(".menu-close-btn").hide()
        $(".menu-btn").show()
        $("body").css("overflow-y", "unset")
    });
});
