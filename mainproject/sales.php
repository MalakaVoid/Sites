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
            $link = mysqli_connect("localhost", "root", "root");
            mysqli_select_db($link, "db1");
            mysqli_set_charset($link, "utf8");

            $querry = "SELECT * FROM items WHERE sale = 1";
            $result_query_items = mysqli_query($link,$querry);

            echo "<h1>АКЦИИ</h1><hr>";
            echo "<div class='menu-content'>";
            while ($item = mysqli_fetch_array($result_query_items)){
                echo "<div class='item-card'>
                        <img src='images/burger1.png' alt='Burger1' class='image-card'>
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
                            <button class='add-product'>
                                Добавить
                            </button>
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