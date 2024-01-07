
$("#login-input").focus(function(){
    $(".login-input-container").toggleClass("focused");
});

$("#login-input").focusout(function(){
    $(".login-input-container").toggleClass("focused");
});


$("#password-input").focus(function(){
    $(".password-input-container").toggleClass("focused");
});

$("#password-input").focusout(function(){
    $(".password-input-container").toggleClass("focused");
});
