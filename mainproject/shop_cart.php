<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: /authorization.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Menu</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/header_footer.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main id="shop-cart-page">
        <div class='shop-cart-container'>
            <h1>КОРЗИНА</h1>
            <div class='shop-cart-content'>
                <div class='card'>
                    <div>
                        <img src='images/burger1.png' alt='Burger1'>
                        <div class='info'>
                            <h2>Burger</h2>
                            Description
                        </div>
                    </div>
                    <div>
                        <div class='price'>
                            780 P
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include("footer.php");
    ?>
</body>
</html>