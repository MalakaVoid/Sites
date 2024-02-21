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
    <title>Sales</title>
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
            include("database_conn.php");

            $querry = "SELECT * FROM items WHERE sale = 1";
            $result_query_items = mysqli_query($link,$querry);

            echo "<h1>АКЦИИ</h1><hr>";
            echo "<div class='menu-content'>";
            while ($item = mysqli_fetch_array($result_query_items)){
                echo "<div class='item-card'>
                        <img src='{$item['img']}' alt='Burger1' class='image-card'>
                        <div class='info-container'>
                            <div class='title'>
                                {$item['title']}
                            </div>
                            <div class='description'>
                                {$item['description']}
                            </div>
                            <div class='price'>
                                {$item['price']} P
                            </div>
                            <form>
                            <button class='add-product' formmethod='POST' formaction='/menu.php?item_id={$item['item_id']}'>
                                Добавить
                            </button>
                            </form>
                        </div>
                    </div>";
                    
            }
                echo "</div>";
        ?>
        
    </main>
    <?php
        include("footer.php");
    ?>
</body>
</html>