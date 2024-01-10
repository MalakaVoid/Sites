// let inputs = ["#login-input", "#password-input", "#first-name-input", "#last-name-input"];
// let containers = [".login-input-container", ".password-input-container", ".first-name-input-container",".last-name-input-container"];

let inputs_dict = {}
for (let i = 0; i < containers.length; i++){
    inputs_dict[containers[i]] = false;
}
console.log(inputs_dict)

$("#first-name-input").focusout(function(){
    var value = this.value;
    tick(".first-name-input-container", /^[a-zA-Z0-9А-Яа-я]+$/.test(value));
});
$("#last-name-input").focusout(function(){
    var value = this.value;
    tick(".last-name-input-container", /^[a-zA-Z0-9А-Яа-я]+$/.test(value));
});
$("#login-input").focusout(function(){
    var value = this.value;
    tick(".login-input-container", /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value));
});
$("#password-input").focusout(function(){
    var value = this.value;
    tick(".password-input-container", /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(value));
})

function tick(container,flag){
    if (flag) {
        $(container+" svg").css("opacity", "1");
    } else{
        $(container+" svg").css("opacity", "0");
    }
    inputs_dict[container] = flag;
}



$("form").submit(function (e) { 
    let breakFlag = false;
    for (let key in inputs_dict){
        if (!inputs_dict[key]){
            $(key).addClass("hasError");
            breakFlag = true;
        }
    }
    if (breakFlag){
        e.preventDefault();
    }else{
        return;
    }
    
});
