function createOption(value, text){
    return `<option value="${value}">${text}</option>`;
}

function getDistrict(){
    $.ajax({
        url: '/handler_get_choices.php',
        type: 'POST',
        data: {"type": "district"},
        dataType: 'json',
        success: function(data){
            for ([key, value] of Object.entries(data)) {
                $('#district').append(`<option value="${key}">${value}</option>`);
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    })
}

function getRegions(district){
    $.ajax({
        url: '/handler_get_choices.php',
        type: 'POST',
        data: {"type": "region", "region_id": district},
        dataType: 'json',
        success: function(data){
            for ([key, value] of Object.entries(data)) {
                $('#region').append(createOption(key, value));
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    })

    $('#region').slideDown();   
}

function getStreets(region){
    $.ajax({
        url: '/handler_get_choices.php',
        type: 'POST',
        data: {"type": "street", "street_id": region},
        dataType: 'json',
        success: function(data){
            for ([key, value] of Object.entries(data)) {
                $('#street').append(createOption(key, value));
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });

    $('#street').slideDown();
}

$(document).ready(function() {
    // PREPERATIONS
    $('#region').hide();
    $('#street').hide();

    $('#district').empty().append(createOption('none', 'Округ'));
    $('#region').empty().append(createOption('none', 'Район'));
    $('#street').empty().append(createOption('none', 'Улица'));
    getDistrict();

    // DISTINCT ON CHANGE 
    // SLIDE DOWN REGION
    $('#district').change(function(event){
        let district = $(this).val();
        $('#region').empty().append(createOption('none', 'Район'));
        $('#street').slideUp();
        getRegions(district);
    });

    // REGION ON CHANGE 
    // SLIDE DOWN STREET
    $('#region').change(function(event){
        let region = $(this).val();
        $('#street').empty().append(createOption('none', 'Улица'));
        getStreets(region);
    });


    // FORM PROCCESSING
    $('#btn_submit').click(function(event){
        let formData = {
            "district": $('#district').val(),
            "region": $('#region').val(),
            "street": $('#street').val()
        }

        if (formData.district == 'none' || formData.region == 'none' || formData.street =='none'){
            $('.errors').empty().append('Заполните все поля');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/handler_create_address.php',
            data: formData,
            dataType: 'text',
            success: function(data){
                $('.errors').empty();
                $('.result').append(`<div>${data}</div>`);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        })
    })


});