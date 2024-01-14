$(".options div").on("click", function () {
    $(this)
    .find(".dropdown")
    .slideDown("fast");


    $(this).find(".dropdown").on("mouseout", function () {
        $(this)
        .slideUp("fast");
    });
});
