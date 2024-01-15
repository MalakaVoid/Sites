$(".options div").on("click", function () {
    $(".dropdown",this)
    .show("fast");


    $(".dropdown", this)
    .hover(function () {
        return;
    },
    function(){
        $(this).hide("fast");
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