// $('.my-goals').click(function(){
//     $.ajax({
//         url: '/includes/workout_cards_ajax.php',
//         method: 'post',
//         dataType: 'html',
//         data: {a: 2},
//         success: function(data){
//             $(".mini_card_week")
//             .empty()
//             .html(data);
//         }
//     });
// })

let options = {
    "lose_fat" : false,
    "get_toned": false,
    "gain_muscle": false,
    "increase_endurance": false,
    "increase_flexibility": false
    ,
    "full_gym": false,
    "none": false,
    "dumbbells": false,
    "kettlebells": false
    ,
    "beginner": false,
    "intermediate": false,
    "advanced": false
};

$("input").each(function(){
    $(this).change(function (e) { 
        let name = $(this).attr("name");
        toggle_option(name);
        refresh_cards();
    })
});

function toggle_option(name){
    options[name] = !options[name];
};

function refresh_cards(){
    $.ajax({
        url: '/includes/workout_cards_ajax.php',
        method: 'post',
        dataType: 'html',
        data: {"options": options},
        error: function(){
            alert("Something went wrong");
        },
        success: function(data){
            $(".mini_card_week")
            .empty()
            .html(data);
        }
    });
}