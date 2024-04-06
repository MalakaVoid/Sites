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
    <title>Orders page</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main>
        <div class="table_items table_items_orders">

        </div>
        <div class="messages">
            
        </div>
    </main>

    <script id="card_template" type="text/x-custom-template">
        <form class="table_items__card">
            <h3 class="card__title">Заказ 1</h3>
            <div class="card__info">
                <input type="hidden" name="id" disabled value="" />
                <div class="card__name">Клиент</div>
                <div class="card__value"><input disabled type="text" name="user" value=""></div>
                <div class="card__name">Время создания</div>
                <div class="card__value"><input disabled type="text" name="creation_date" value=""></div>
                <div class="card__name">Время доставки</div>
                <div class="card__value"><input disabled type="text" name="delivery_date" value=""></div>
                <div class="card__name">Цена</div>
                <div class="card__value"><input disabled type="text" name="price" value=""></div>
                <div class="card__name">Адресс</div>
                <div class="card__value"><textarea disabled name="address" rows="3"></textarea></div>
            </div>
            <div class="card__buttons">
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
    <script src="./scripts/orders.js"></script>
    <script src="./scripts/screenResize.js"></script>
</body>
</html>