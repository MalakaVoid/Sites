<?php
    session_start();
    if (isset($_SESSION["user"])){
        if ($_SESSION["user"]['is_admin']==0){
            header('Location: /');
            exit;
        }
    }
    else{
        header('Location: ../authorization.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products page</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main>
        <div class="table_items table_items_prdoucts">
            <form class="table_items__card table_items__card_add">
                <h3 class="card__title">ДОБАВИТЬ</h3>
                <div class="card__info">
                    <div class="card__name">Картинка</div>
                    <label class="card__image">
                        <input type='file' class='img-file' name='image'>
                        <div class='card__image_preview'>
                            <img src=''>
                        </div>
                        <div class="card__button card__image_button">Изменить</div>
                    </label>
                    <div class="card__name">Название</div>
                    <div class="card__value"><input  type="text" name="title" value=""></div>
                    <div class="card__name">Описание</div>
                    <div class="card__value"><textarea name="description" rows="5"></textarea></div>
                    <div class="card__name">Цена</div>
                    <div class="card__value"><input type="number" name="price" value=""></div>
                    <div class="card__name">Категория</div>
                    <div class="card__value"><input type="text" name="category" value=""></div>
                    <div class="card__name">Скидка</div>
                    <div class="card__value"><input type="checkbox" name="sale" ></div>
                    <div class="card__name">Видимость</div>
                    <div class="card__value"><input type="checkbox" name="visible" ></div>
                </div>
                <div class="card__buttons">
                    <button type="button" class="card__button card__button_add_user">ДОБАВИТЬ</button>
                </div>
            </form>

        </div>
        <div class="messages">
            
        </div>
    </main>

    <script id="card_template" type="text/x-custom-template">
        <form class="table_items__card">
            <h3 class="card__title"></h3>
            <div class="card__info">
                <input type="hidden" name="id" disabled value="" />
                <div class="card__name">Картинка</div>
                <label class="card__image">
                    <input type='file' class='img-file' disabled name='image'>
                    <div class='card__image_preview'>
                        <img src=''>
                    </div>
                    <div class="card__button card__image_button">Изменить</div>
                </label>
                <div class="card__name">Название</div>
                <div class="card__value"><input disabled type="text" name="title" value=""></div>
                <div class="card__name">Описание</div>
                <div class="card__value"><textarea disabled name="description" rows="8"></textarea></div>
                <div class="card__name">Цена</div>
                <div class="card__value"><input disabled type="number" name="price" value=""></div>
                <div class="card__name">Категория</div>
                <div class="card__value"><input disabled type="text" name="category" value=""></div>
                <div class="card__name">Скидка</div>
                <div class="card__value"><input type="checkbox" disabled name="sale" ></div>
                <div class="card__name">Видимость</div>
                <div class="card__value"><input type="checkbox" disabled name="visible" ></div>
            </div>
            <div class="card__buttons">
                <button type="button" class="card__button card__button_save">СОХРАНИТЬ</button>
                <button type="button" class="card__button card__button_edit"><img src="./images/edit.png"></button>
                <button type="button" class="card__button card__button_delete"><img src="./images/bin.png"></button>
            </div>
        </form>
      </script>
      <script id="message_template" type="text/x-custom-template">
        <div class="messages__message">
            <h3 class="message__title"></h3>
            <p class="message__description"></p>
        </div>
      </script>
    <script src="./scripts/jq.js"></script>
    <script src="./scripts/products.js"></script>
    <script src="./scripts/screenResize.js"></script>
</body>
</html>