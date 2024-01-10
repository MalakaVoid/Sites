let inputs = ["#login-input", "#password-input"];
let containers = [".login-input-container", ".password-input-container"];

for (let i = 0; i < inputs.length; i++) {
    $(inputs[i]).focus(function(){
        $(containers[i]).toggleClass("focused");
    });
    
    $(inputs[i]).focusout(function(){
        $(containers[i]).toggleClass("focused");
    });
};

let inputs_dict = {}
for (let i = 0; i < containers.length; i++){
    inputs_dict[containers[i]] = false;
}

$("#login-input").focusout(function(){
    var value = this.value;
    if (/^[a-zA-Z0-9.@]+$/.test(value)){
        inputs_dict[".login-input-container"] = true;
    }else{
        inputs_dict[".login-input-container"] = false;
    }
});
$("#password-input").focusout(function(){
    var value = this.value;
    if (/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(value)){
        inputs_dict[".password-input-container"] = true;
    }else{
        inputs_dict[".password-input-container"] = false;
    }
})

$("form").submit(function (e) { 
    let breakFlag = false;
    for (let key in inputs_dict){
        if (!inputs_dict[key]){
            $(key).addClass("hasError");
            breakFlag = true;
        }else{
            $(key).removeClass("hasError");
        }
    }
    if (breakFlag){
        e.preventDefault();
    }else{
        return;
    }
});
