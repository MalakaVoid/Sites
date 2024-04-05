$(document).ready(function(){
    // CARD BUTTONS PROCCESSING 
    function cardHooks(){
        // CARD BUTTON EDIT PROCESSOR
        $('.table_items__card')
        .find('.card__button_edit').unbind('click');

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
        .find('.card__button_delete').unbind('click');

        $('.table_items__card')
        .find('.card__button_delete')
        .click(function(){
    
            let parent = $(this).parents('.table_items__card');
            let input = $(parent).find('input[name="id"]');
    
            let deleteUserId = $(input).val();
            deleteUser(deleteUserId);
    
        });
    
    
        // SAVE EDIT BUTTON PROCESSOR
        $('.table_items__card')
        .find('.card__button_save').unbind('click');
        
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
    
            editUser(currentEditCard);
    
            clearPreviousCard(currentEditCard); // change to ajax response
    
        });
    }

    function showMessage(messageTitle, messageText, messageType){
        message = $($('#message_template').html());

        $(message).find('.message__title').empty().text(messageTitle);
        $(message).find('.message__description').empty().append(messageText);

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

        // console.log(currentEditCard);
    }

    // CREATE CARD
    function createUserCard(userData){
        card = $($("#card_template").html());
        $(card).find('.card__title').empty().text(`USER ${userData.id}`);
        $(card).find('input[name="id"]').val(userData.id);
        $(card).find('input[name="login"]').val(userData.login);
        $(card).find('input[name="password"]').val(userData.password);
        $(card).find('input[name="name"]').val(userData.name);
        $(card).find('input[name="surname"]').val(userData.surname);
        $(card).find('input[name="email"]').val(userData.email);
        $(card).find('input[name="admin"]').prop('checked', userData.admin);
        $('.table_items').append(card);

        cardHooks();
    }

// AJAX---------------------------------------------------------------------------
    // CREATION OF TABLE
    function getAllUsers(){
        $.ajax({
            type: "POST",
            url: "/adminV2/handlers/users_handlers.php",
            dataType: "json",
            data: {type: 'GET_USERS'},
            success: function (response) {
                for (let user of response.data) {

                    let userData = {
                        id: user['user_id'],
                        login: user['login'],
                        password: user['password'],
                        name: user['first_name'],
                        surname: user['last_name'],
                        email: user['email'],
                        admin:!!parseInt(user['is_admin'])
                    }

                    createUserCard(userData);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
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
                showMessage(
                    "Добавление пользователя",
                    response.message,
                   response.status_code == 200?'success': 'error'
                );
                
                if (response.status_code != 200){
                    return;
                }

                let user = response.data;
                let userData = {
                    id: user['user_id'],
                    login: user['login'],
                    password: user['password'],
                    name: user['first_name'],
                    surname: user['last_name'],
                    email: user['email'],
                    admin:!!parseInt(user['is_admin'])
                }

                createUserCard(userData);
                $('.table_items__card_add input[type="text"]').val("");
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function deleteUser(userId){

        $.ajax({
            type: "POST",
            url: "/adminV2/handlers/users_handlers.php",
            dataType: "json",
            data: {type: 'DELETE_USER', data: userId},
            success: function (response) {
                if (response.status_code != 200){
                    showMessage(
                        "Удаление пользователя",
                        response.message,
                        response.status_code == 200?'success': 'error'
                    );
                    return;
                }

                let user = response.data;
                let userData = {
                    id: user['user_id'],
                    login: user['login'],
                    password: user['password'],
                    name: user['first_name'],
                    surname: user['last_name'],
                    email: user['email'],
                    admin:!!parseInt(user['is_admin'])
                }

                showMessage(
                    "Удаление пользователя",

                    `${response.message } <br>
                    id: ${userData.id}<br>
                    login: ${userData.login}<br>
                    password: ${userData.password}<br>
                    name: ${userData.name}<br>
                    surname: ${userData.surname}<br>
                    email: ${userData.email}<br>
                    <span class="message__date">${response.date}</span>
                    `,
                    
                    response.status_code == 200?'success': 'error'
                );

                $(`input[name="id"][value="${userData.id}"]`).parents('.table_items__card').remove();

            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function editUser(userData){

        $.ajax({
            type: "POST",
            url: "/adminV2/handlers/users_handlers.php",
            dataType: "json",
            data: {type: 'EDIT_USER', data: userData},
            success: function (response) {

                console.log(response);
                if (response.status_code != 200){
                    showMessage(
                        "Редактирование пользователя",
                        response.message,
                        response.status_code == 200?'success': 'error'
                    );
                    return;
                }

                let user = response.data;
                let userData = {
                    id: user['user_id'],
                    login: user['login'],
                    password: user['password'],
                    name: user['first_name'],
                    surname: user['last_name'],
                    email: user['email'],
                    admin:!!parseInt(user['is_admin'])
                }

                showMessage(
                    "Редактирование пользователя",

                    `${response.message } <br>
                    id: ${userData.id}<br>
                    login: ${userData.login}<br>
                    password: ${userData.password}<br>
                    name: ${userData.name}<br>
                    surname: ${userData.surname}<br>
                    email: ${userData.email}<br>
                    <span class="message__date">${response.date}</span>
                    `,
                    
                    response.status_code == 200?'success': 'error'
                );

            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });

    }
// AJAX-END---------------------------------------------------------------------------

// MAIN-CODE----------------------------------------------------------------
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

        addNewUser(newUserData);


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


// MAIN-CODE-END----------------------------------------------------------------
});