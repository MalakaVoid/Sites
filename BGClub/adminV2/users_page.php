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
    <title>Main admin page</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main>
        <div class="table_items table_items_users">
            <div class="table_items__card table_items__card_add">
                <h3 class="card__title">ДОБАВИТЬ</h3>
                <div class="card__info">
                    <div class="card__name">Логин</div>
                    <div class="card__value"><input  type="text" name="login" value=""></div>
                    <div class="card__name">Пароль</div>
                    <div class="card__value"><input type="text" name="password" value=""></div>
                    <div class="card__name">Имя</div>
                    <div class="card__value"><input type="text" name="name" value=""></div>
                    <div class="card__name">Фамилия</div>
                    <div class="card__value"><input type="text" name="surname" value=""></div>
                    <div class="card__name">Email</div>
                    <div class="card__value"><input type="text" name="email" value=""></div>
                    <div class="card__name">Админ</div>
                    <div class="card__value"><input type="checkbox" name="admin" ></div>
                </div>
                <div class="card__buttons">
                    <button class="card__button card__button_add_user">ДОБАВИТЬ</button>
                </div>
            </div>

        </div>
        <div class="messages">

        </div>
    </main>

    <script id="card_template" type="text/x-custom-template">
        <div class="table_items__card">
            <h3 class="card__title"></h3>
            <div class="card__info">
                <input type="hidden" name="id" disabled value="" />
                <div class="card__name">Логин</div>
                <div class="card__value"><input disabled type="text" name="login" value=""></div>
                <div class="card__name">Пароль</div>
                <div class="card__value"><input disabled type="text" name="password" value=""></div>
                <div class="card__name">Имя</div>
                <div class="card__value"><input disabled type="text" name="name" value=""></div>
                <div class="card__name">Фамилия</div>
                <div class="card__value"><input disabled type="text" name="surname" value=""></div>
                <div class="card__name">Email</div>
                <div class="card__value"><input disabled type="text" name="email" value=""></div>
                <div class="card__name">Админ</div>
                <div class="card__value"><input disabled type="checkbox" name="admin" ></div>
            </div>
            <div class="card__buttons">
                <button class="card__button card__button_save">СОХРАНИТЬ</button>
                <button class="card__button card__button_edit"><img src="./images/edit.png"></button>
                <button class="card__button card__button_delete"><img src="./images/bin.png"></button>
            </div>
        </div>
      </script>
      <script id="message_template" type="text/x-custom-template">
        <div class="messages__message">
            <h3 class="message__title"></h3>
            <p class="message__description"></p>
        </div>
      </script>
    <script src="./scripts/jq.js"></script>
    <script src="./scripts/users.js"></script>
    <script src="./scripts/screenResize.js"></script>
</body>
</html>