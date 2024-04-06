$(document).ready(function(){
    // CARD BUTTONS PROCCESSING 
    function cardHooks(){
        // DELETE BUTTON PROCESSOR 
        $('.table_items__card')
        .find('.card__button_delete').unbind('click');

        $('.table_items__card')
        .find('.card__button_delete')
        .click(function(){
    
            let parent = $(this).parents('.table_items__card');
            let input = $(parent).find('input[name="id"]');
    
            let deleteOrderId = $(input).val();
            deleteOrder(deleteOrderId);
    
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

    // CREATE CARD
    function createOrderCard(orderData){
        card = $($("#card_template").html());
        $(card).find('.card__title').empty().text(`ORDER ${orderData.id}`);
        $(card).find('input[name="id"]').val(orderData.id);
        $(card).find('input[name="user"]').val(orderData.user);
        $(card).find('input[name="creation_date"]').val(orderData.creationDate);
        $(card).find('input[name="delivery_date"]').val(orderData.arrivalDate);
        $(card).find('input[name="price"]').val(orderData.price);
        $(card).find('[name="address"]').val(orderData.address);
        console.log(orderData);
        $('.table_items').append(card);

        cardHooks();
    }

// AJAX---------------------------------------------------------------------------
    // CREATION OF TABLE
    function getAllOrders(){
        $.ajax({
            type: "POST",
            url: "/adminV2/handlers/orders_handlers.php",
            dataType: "json",
            data: {type: 'GET_ORDERS'},
            success: function (response) {
                console.log(response);
                for (let order of response.data) {

                    let orderData = {
                        id: order['order_id'],
                        user: order['user'],
                        arrivalDate: order['order_arrival_date'],
                        creationDate: order['order_creation_date'],
                        price: order['price'],
                        address: order['addres'],
                    }

                    createOrderCard(orderData);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function deleteOrder(orderId){

        $.ajax({
            type: "POST",
            url: "/adminV2/handlers/orders_handlers.php",
            dataType: "json",
            data: {type: 'DELETE_ORDER', data: orderId},
            success: function (response) {
                console.log(response);
                if (response.status_code != 200){
                    showMessage(
                        "Удаление заказа",
                        response.message,
                        response.status_code == 200?'success': 'error'
                    );
                    return;
                }

                let order = response.data;
                let orderData = {
                    id: order['order_id'],
                    user: order['user'],
                    arrivalDate: order['order_arrival_date'],
                    creationDate: order['order_creation_date'],
                    price: order['price'],
                    address: order['addres'],
                }

                showMessage(
                    "Удаление заказа",

                    `${response.message } <br>
                    id: ${orderData.id}<br>
                    user: ${orderData.user}<br>
                    arrivalDate: ${orderData.arrivalDate}<br>
                    creationDate: ${orderData.creationDate}<br>
                    price: ${orderData.price}<br>
                    address: ${orderData.address}<br>
                    <span class="message__date">${response.date}</span>
                    `,
                    
                    response.status_code == 200?'success': 'error'
                );

                $(`input[name="id"][value="${orderData.id}"]`).parents('.table_items__card').remove();

            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

// AJAX-END---------------------------------------------------------------------------

// MAIN-CODE----------------------------------------------------------------

    // FUNCTION CALL GET USERS 
    getAllOrders();
    cardHooks();


// MAIN-CODE-END----------------------------------------------------------------
});