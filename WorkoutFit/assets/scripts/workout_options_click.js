$(".container").on("click", function () {
    $(this).next()
    .show("fast", function(){
        $(this)
        .hover(function () {
            return;
        },
        function(){
            $(this).hide("fast");
        })

        
    });


    $(this).next()
    .find(".blank").click(function(){
        $(this).parent()
        .hide("fast");
    })


    // $(this).next()
    // .mouseout(function () {
    //     return;
    // },
    // function(){
    //     $(this).hide("fast").toggleClass("shown");
    // })
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