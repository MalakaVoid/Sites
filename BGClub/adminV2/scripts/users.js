$(document).ready(function(){
    // CARD BUTTONS PROCCESSING 
    function cardHooks(){
        // CARD BUTTON EDIT PROCESSOR
        $('.table_items__card')
        .find('.card__button_edit')
        .click(function(){
            let isDoubleClick = $(this).parents('.table_items__card').hasClass("table_items__card_edit");
            clearPreviousCard(currentEditCard);
    
            if (isDoubleClick){
                return;
            }
            
            let parent_card = $(this).parents('.table_items__card');
            let inputs = $(parent_card).find('input');
    
            for (let input of inputs) {
                if (input.name == 'admin'){
                    currentEditCard[input.name] = input.checked;
                    continue;
                }
                currentEditCard[input.name] = input.value;
            }
    
            $(parent_card)
            .toggleClass("table_items__card_edit")
            .find('input').
            attr('disabled', !$(inputs).attr('disabled'));
    
        });
    
    
        // DELETE BUTTON PROCESSOR 
        $('.table_items__card')
        .find('.card__button_delete')
        .click(function(){
    
            let parent = $(this).parents('.table_items__card');
            let input = $(parent).find('input[name="id"]');
    
            let deleteUserId = $(input).val();
            console.log(deleteUserId);
    
        });
    
    
        // SAVE EDIT BUTTON PROCESSOR
        $('.table_items__card')
        .find('.card__button_save')
        .click(function(){
    
            let parent_card = $(this).parents('.table_items__card');
            let inputs = $(parent_card).find('input');
    
            for (let input of inputs) {
                if (input.name == 'admin'){
                    currentEditCard[input.name] = input.checked;
                    continue;
                }
                currentEditCard[input.name] = input.value;
            }
    
            console.log(`Data to send:`);
            console.log(currentEditCard);
    
            showMessage("Успешно изменено", currentEditCard, "success");
    
            clearPreviousCard(currentEditCard); // change to ajax response
    
        });
    }

    function showMessage(messageTitle, messageText, messageType){
        message = $($('#message_template').html());

        $(message).find('.message__title').empty().text(messageTitle);
        $(message).find('.message__description').empty().text(messageText);

        switch (messageType) {
            case 'error':
                $(message).addClass('messages__message_error');
              break;
            case 'success':
                $(message).addClass('messages__message_success');
              break;
            case 'warning':
                $(message).addClass('messages__message_warning');
              break;
            default:
              console.log(`Wrong message type`);
        }

        $('.messages').prepend(message);
        $(message).slideDown();
    }


    function clearPreviousCard(dataCard){
        let card = $('.table_items__card_edit');
        $(card).find('input[name="login"]').val(dataCard.login);
        $(card).find('input[name="password"]').val(dataCard.password);
        $(card).find('input[name="name"]').val(dataCard.name);
        $(card).find('input[name="surname"]').val(dataCard.surname);
        $(card).find('input[name="email"]').val(dataCard.email);
        $(card).find('input[name="admin"]').prop('checked', dataCard.admin);

        $(card)
        .removeClass("table_items__card_edit")
        .find('input')
        .attr('disabled', true);

        console.log(currentEditCard);
    }

    // CREATION OF TABLE
    function getAllUsers(){
        $.ajax({
            type: "POST",
            url: "/adminV2/handlers/users_handlers.php",
            dataType: "json",
            data: {type: 'GET_USERS'},
            success: function (response) {
                for (let user of response.data) {

                    card = $($("#card_template").html());
                    $(card).find('.card__title').empty().text(`USER ${user['user_id']}`);
                    $(card).find('input[name="id"]').val(user['user_id']);
                    $(card).find('input[name="login"]').val(user['login']);
                    $(card).find('input[name="password"]').val(user['password']);
                    $(card).find('input[name="name"]').val(user['first_name']);
                    $(card).find('input[name="surname"]').val(user['last_name']);
                    $(card).find('input[name="email"]').val(user['email']);
                    $(card).find('input[name="admin"]').prop('checked', !!parseInt(user['is_admin']));
                    $('.table_items').append(card);
                }
                cardHooks();
            }
        });
    }

    function addNewUser(userData){
        $.ajax({
            type: "POST",
            url: "/adminV2/handlers/users_handlers.php",
            dataType: "json",
            data: {type: 'ADD_USER', data: userData},
            success: function (response) {
                console.log(response);
            }
        });
    }

    // ADD NEW USER BUTTON PROCCESSING
    $('.table_items__card_add')
    .find('.card__button_add_user')
    .click(function(){

        let newUserData = {
            login: null,
            password: null,
            name: null,
            surname: null,
            email: null,
            admin: false,
        };

        let cardParent = $(this).parents('.table_items__card_add');
        let inputs = $(cardParent).find('input');

        for (let input of inputs) {

            if (input.value.trim() === ''){
                showMessage(
                    "Добавление пользователя",
                    "Заполните все поля!",
                    "error"
                );
                return;
            }

            if (input.name == 'admin'){
                newUserData[input.name] = input.checked;
                continue;
            }
            newUserData[input.name] = input.value;
        }

        console.log(newUserData);

    });


    let currentEditCard = {
        id: null,
        login: null,
        password: null,
        name: null,
        surname: null,
        email: null,
        admin: false,
    };


    // FUNCTION CALL GET USERS 
    getAllUsers();
    cardHooks();

});