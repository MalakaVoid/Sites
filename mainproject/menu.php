<?php
    session_start();
    if (isset($_SESSION["user"]) && isset($_GET['item_id'])){
        $_SESSION["shop_cart_count"] +=1;
        $_SESSION["shop_cart"][]=$_GET['item_id'];
    }
    else if (isset($_GET['item_id'])){
        header('Location: /authorization.php');
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
    <article>
        <div class="main-container-image">
            <img src="images/banner-menu.png" class="main-image" alt="Burger image">  
        </div>
    </article>
    <main id="container-menu">
        <?php
            include("menu_creation.php");
        ?>
        
    </main>
    <?php
        include("footer.php");
    ?>
</body>
</html>