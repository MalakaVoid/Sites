let cards = [".card-1", ".card-2", ".card-3", ".card-4"]
let current_card_id = 0;


function change_card(prev_id, new_id){
    $(cards[new_id]).css("left", "0");

    $(cards[new_id]).fadeIn(700);
    $(cards[prev_id]).fadeOut(900);

    // $(cards[prev_id]).css("left", "100%");
    $("#owl-dot-"+prev_id).toggleClass("active");
    $("#owl-dot-"+new_id).toggleClass("active");
}

setInterval(()=>{
    if (!$(".sec-1").is(":hover")){
        if (current_card_id == cards.length-1){
            change_card(current_card_id, 0);
            current_card_id = 0;
        } else{
            change_card(current_card_id, current_card_id+1);
            current_card_id++;
        }
    }
}, 10000);

for (let i = 0; i < cards.length; i++ ){
    $("#owl-dot-"+i).click(function () { 
        if (current_card_id != i){
            change_card(current_card_id, i);
        }
        current_card_id = i;
    });
}

$(".arrow-right").click(function () { 
    if (current_card_id == cards.length-1){
        change_card(current_card_id, 0);
        current_card_id = 0;
    } else{
        change_card(current_card_id, current_card_id+1);
        current_card_id++;
    }
});
$(".arrow-left").click(function () { 
    if (current_card_id == 0){
        change_card(current_card_id, cards.length-1);
        current_card_id = cards.length-1;
    } else{
        change_card(current_card_id, current_card_id-1);
        current_card_id--;
    }
});