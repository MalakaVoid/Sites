$('.my-goals').click(function(){
    $.ajax({
        url: '/includes/workout_cards_ajax.php',
        method: 'post',
        dataType: 'html',
        data: {a: 2},
        success: function(data){
            $(".mini_card_week")
            .empty()
            .html(data);
        }
    });



})