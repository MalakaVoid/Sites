function cardHooks(){
    // EDIT BUTTON PROCESSOR
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
        let inputs = $(parent_card).find('[name]');
        let imagePath = $(parent_card).find('.card__image').find('img').prop('src');

        for (let input of inputs) {
            currentEditCard[input.name] = input.value;
        }
        currentEditCard.image = imagePath;

        $(parent_card)
        .toggleClass("table_items__card_edit")
        .find('[name]').
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
        // deleteUser(deleteUserId);

    });
}

function clearPreviousCard(dataCard){
    let card = $('.table_items__card_edit');
    $(card).find('.card__image').find('img').prop('src', dataCard.image);
    $(card).find('input[name="image"]').val("");
    $(card).find('input[name="title"]').val(dataCard.title);
    $(card).find('input[name="description"]').val(dataCard.description);
    $(card).find('input[name="price"]').val(dataCard.price);
    $(card).find('input[name="category"]').val(dataCard.category);

    $(card)
    .removeClass("table_items__card_edit")
    .find('input')
    .attr('disabled', true);

    // console.log(currentEditCard);
}


function createProductCard(productData){
    card = $($("#card_template").html());
    $(card).find('.card__title').empty().text(`Товар ${productData.id}`);
    $(card).find('.card__image').find('img').prop('src', productData.image);
    $(card).find('[name="id"]').val(productData.id);
    $(card).find('[name="title"]').val(productData.title);
    $(card).find('[name="description"]').val(productData.description);
    $(card).find('[name="price"]').val(productData.price);
    $(card).find('[name="category"]').val(productData.category);
    $('.table_items').append(card);
    console.log(productData);

    cardHooks();
}
// AJAX ----------------------------------------------------------------
function getAllProductCards(){
    $.ajax({
        type: "POST",
        url: "/adminV2/handlers/products_handlers.php",
        dataType: "json",
        data: {type: 'GET_PRODUCTS'},
        success: function (response) {
            for (let product of response.data) {

                let productData = {
                    id: product['item_id'],
                    image: product['img'],
                    title: product['title'],
                    description: product['description'],
                    price: product['price'],
                    category: product['category'],
                }

                createProductCard(productData);
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}

function addNewProduct(productData){
    productData.append('type', 'ADD_PRODUCT');
    $.ajax({
        type: "POST",
        url: "/adminV2/handlers/products_handlers.php",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: productData,
        success: function (response) {
            console.log(response);
                showMessage(
                    "Добавление товара",
                    response.message,
                   response.status_code == 200?'success': 'error'
                );
                
                if (response.status_code != 200){
                    return;
                }

                let product = response.data;
                let productData = {
                    id: product['item_id'],
                    image: product['img'],
                    title: product['title'],
                    description: product['description'],
                    price: product['price'],
                    category: product['category'],
                }

                createProductCard(productData);
                $('.table_items__card_add').find('[name]').val("");
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}
// AJAX-END----------------------------------------------------------------

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

// MAIN 
let currentEditCard = {
    id: null,
    image: null,
    title: null,
    description: null,
    price: null,
    category: null
};

$(document).ready(function() {
    getAllProductCards();
    cardHooks();

    $('.table_items__card_add')
    .find('.card__button_add_user')
    .click(function(){

        let form = $(this).parents('form');
        let formData = new FormData(form[0]);
        formData.append('image', $(this).parents('form').find('input[name="image"]')[0].files[0]);

        for (let [name, value] of formData.entries()) {
            if (name === 'image'){
                if (value.name == "") {
                    showMessage(
                        "Добавление товара",
                        "Выберите изображение!",
                        "error"
                    );
                    return;
                }
                continue;
            }
            if (value == ''){
                showMessage(
                    "Добавление товара",
                    "Заполните все поля!",
                    "error"
                );
                return;
            }
        }

        // console.log(productData); //ADD NEW DATA AJAX FUNC
        addNewProduct(formData);

    });

});