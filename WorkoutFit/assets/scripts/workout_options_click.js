let flag = false;
$(".container").on("click", function () {
    if (flag){
        $(this).next().hide("fast");
        flag = !flag;
        return;
    } else{
        $(this).next().show("fast");
        flag = !flag;
    }

    $(this).next()
    .show("fast", function(){
        $(this).parent()
        .hover(function () {
            return;
        },
        function(){
            $(this).find(".dropdown")
            .hide("fast");
            flag=false;
        })
    });
});


$(".sec-2 input").change(function(){
    $(this)
    .parent()
    .find(".toggle-container")
    .toggleClass("toggle-checked");
});

$("#input-search").focus(function(){
    $(".input-search-container").toggleClass("focused");
}).focusout(function(){
    $(".input-search-container").toggleClass("focused");
})



$(".settings-button").click(function(){
    if ($(".options").hasClass("shown")){
        $(".options")
        .slideUp("fast")
        .toggleClass("shown");
        return;
    }

    $(".options")
    .slideDown("fast")
    .css("display", "flex")
    .toggleClass("shown");
});