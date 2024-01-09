let inputs = ["#login-input", "#password-input", "#first-name-input", "last-name-input"];
let containers = [".login-input-container", ".password-input-container", ".first-name-input-container",".last-name-input-container"];


for (let i = 0; i < inputs.length; i++) {
    $(inputs[i]).focus(function(){
        $(containers[i]).toggleClass("focused");
    });
    
    $(inputs[i]).focusout(function(){
        $(containers[i]).toggleClass("focused");
    });
};
$("#first-name-input").on('keyup input', function(){
    var value = this.value;
    tick(".first-name-input-container", /^[a-zA-Z0-9А-Яа-я]+$/.test(value));
})
$("#last-name-input").on('keyup input', function(){
    var value = this.value;
    tick(".last-name-input-container", /^[a-zA-Z0-9А-Яа-я]+$/.test(value));
})
function tick(container,flag){
    if (flag) {
        $(container+" svg").css("opacity", "1");
    } else{
        $(container+" svg").css("opacity", "0");
    }
}