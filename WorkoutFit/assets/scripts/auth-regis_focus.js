let inputs = ["#login-input", "#password-input", "#first-name-input", "#last-name-input"];
let containers = [".login-input-container", ".password-input-container", ".first-name-input-container",".last-name-input-container"];

for (let i = 0; i < inputs.length; i++) {
    $(inputs[i]).focus(function(){
        $(containers[i]).toggleClass("focused");
    });
    
    $(inputs[i]).focusout(function(){
        $(containers[i]).toggleClass("focused");
    });
};