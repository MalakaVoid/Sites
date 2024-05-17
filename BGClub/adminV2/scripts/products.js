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
        if ($(parent_card).find('[name="sale"]').prop('checked')) {
            currentEditCard.sale = 1;
        } else{
            currentEditCard.sale = 0;
        }

        if ($(parent_card).find('[name="visible"]').prop('checked')) {
            currentEditCard.visible = 0;
        } else{
            currentEditCard.visible = 1;
        }

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

        let deleteProductId = $(input).val();
        deleteProduct(deleteProductId);

    });

    // PREVIEW IMAGE
    $('.table_items__card')
    .find('input[name="image"]').unbind('change');

    $('.table_items__card')
    .find('input[name="image"]')
    .change(function(){
        let form = $(this).parents('form');
        let file = $(form).find('input[name="image"]')[0].files[0];
        $(form).find('.card__image_preview').find('img')[0].src = window.URL.createObjectURL(file);


    });

    // SAVE EDIT BUTTON PROCESSOR
    $('.table_items__card')
    .find('.card__button_save').unbind('click');
    
    $('.table_items__card')
    .find('.card__button_save')
    .click(function(){

        let form = $(this).parents('form');
        let formData = new FormData(form[0]);
        let image = $(this).parents('form').find('input[name="image"]')[0].files[0];

        if (image == undefined || image.name == ''){
            let imagePath = $(this).parents('form').find('.card__image').find('img').prop('src');
            formData.set('image', imagePath);
        } else{
            formData.set('image', image);
        }

        for (let [name, value] of formData.entries()) {
            console.log(name, value);
            if (value == ''){
                showMessage(
                    "Изменение товара",
                    "Заполните все поля!",
                    "error"
                );
                return;
            }
        }

        editProduct(formData);

    });
}

function clearPreviousCard(dataCard){
    let card = $('.table_items__card_edit');
    $(card).find('.card__image').find('img').prop('src', dataCard.image);
    $(card).find('[name="image"]').val("");
    $(card).find('[name="title"]').val(dataCard.title);
    $(card).find('[name="description"]').val(dataCard.description);
    $(card).find('[name="price"]').val(dataCard.price);
    $(card).find('[name="category"]').val(dataCard.category);
    $(card).find('[name="sale"]').prop('checked', dataCard.sale == 1);
    $(card).find('[name="visible"]').prop('checked', dataCard.visible == 0);

    $(card)
    .removeClass("table_items__card_edit")
    .find('[name]')
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
    $(card).find('[name="sale"]').prop('checked', productData.sale == 1);
    $(card).find('[name="visible"]').prop('checked', productData.visible == 0);

    $('.table_items').append(card);
    // console.log(productData);

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
                    sale: product['sale'],
                    visible: product['is_visible']
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
                    sale: product['sale'],
                    visible: product['is_visible']
                }

                createProductCard(productData);
                $('.table_items__card_add').find('[name]').val('');
                $('.table_items__card_add').find('.card__image').find('img').prop('src', '');
                $('.table_items__card_add').find('[type="checkbox"]').prop('checked', false);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}

function deleteProduct(productId){
    console.log(productId);
    $.ajax({
        type: "POST",
        url: "/adminV2/handlers/products_handlers.php",
        dataType: "json",
        data: {type: 'DELETE_PRODUCT', data: productId},
        success: function (response) {
            if (response.status_code != 200){
                showMessage(
                    "Удаление товара",
                    response.message,
                    response.status_code == 200?'success': 'error'
                );
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
                sale: product['sale'],
                visible: product['is_visible']
            }

            showMessage(
                "Удаление товара",

                `${response.message } <br>
                id: ${productData.id}<br>
                image: ${productData.image}<br>
                title: ${productData.title}<br>
                description: ${productData.description}<br>
                price: ${productData.price}<br>
                category: ${productData.category}<br>
                sale: ${!!productData.sale}<br>
                visible: ${!productData.visible}<br>
                <span class="message__date">${response.date}</span>
                `,
                
                response.status_code == 200?'success': 'error'
            );

            $(`input[name="id"][value="${productData.id}"]`).parents('.table_items__card').remove();

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}

function editProduct(productData){
    productData.append('type', 'EDIT_PRODUCT');
    $.ajax({
        type: "POST",
        url: "/adminV2/handlers/products_handlers.php",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: productData,
        success: function (response) {
            
            if (response.status_code != 200){
                showMessage(
                    "Изменение товара",
                    response.message,
                    response.status_code == 200?'success': 'error'
                );
                return;
            }

            let prevProduct = response.data.prev_product;
            let newProduct = response.data.new_product;
            let prevProductData = {
                id: prevProduct['item_id'],
                image: prevProduct['img'],
                title: prevProduct['title'],
                description: prevProduct['description'],
                price: prevProduct['price'],
                category: prevProduct['category'],
                sale: prevProduct['sale'],
                visible: prevProduct['is_visible']
            }

            let newProductData = {
                id: newProduct['item_id'],
                image: newProduct['img'],
                title: newProduct['title'],
                description: newProduct['description'],
                price: newProduct['price'],
                category: newProduct['category'],
                sale: newProduct['sale'],
                visible: newProduct['is_visible']
            }

            showMessage(
                "Изменение товара",

                `${response.message } <br>
                id: ${newProductData.id}<br>
                image: ${prevProductData.image} -> ${newProductData.image}<br>
                title: ${prevProductData.title} -> ${newProductData.title}<br>
                description: ${prevProductData.description} -> ${newProductData.description}<br>
                price: ${prevProductData.price} -> ${newProductData.price}<br>
                category: ${prevProductData.category} -> ${newProductData.category}<br>
                sale: ${!!parseInt(prevProductData.sale)} -> ${!!parseInt(newProductData.sale)}<br>
                visible: ${!parseInt(prevProductData.visible)} -> ${!parseInt(newProductData.visible)}<br>
                <span class="message__date">${response.date}</span>
                `,
                
                response.status_code == 200?'success': 'error'
            );
            
            let card = $(`input[name="id"][value="${newProductData.id}"]`).parents('form');
            
            $(card).find('.card__image').find('img').prop('src', newProductData.image);
            $(card).find('[name="id"]').val(newProductData.id);
            $(card).find('[name="title"]').val(newProductData.title);
            $(card).find('[name="description"]').val(newProductData.description);
            $(card).find('[name="price"]').val(newProductData.price);
            $(card).find('[name="category"]').val(newProductData.category);
            $(card).find('[name="sale"]').prop('checked', newProductData.sale == 1);
            $(card).find('[name="visible"]').prop('checked', newProductData.visible == 0);
            $(card)
            .removeClass("table_items__card_edit")
            .find('[name]')
            .attr('disabled', true);
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
    category: null,
    sale: null,
    visible: null
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