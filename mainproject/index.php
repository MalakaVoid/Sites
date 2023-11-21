<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Trainings</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/header_footer.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>
    <!-- MAIN CONTENT -->
    <article>
        <div class="main-container-image">
            <img src="images/preview-2-min.png" class="main-image" alt="Burger image">  
        </div>
    </article>
    <main>
        <div class="container-inf">
            <div class="block-text">
                <h2>Интерьер</h2>
                <p>
                    Уютный интерьер и изысканная кухня сделают ваш обед или ужин незабываемым. Мы рады нашим гостям и всегда стремимся их приятно удивить.
                </p>
            </div>
            <img src="images/inter.jpg" alt="none" class="block-img">
        </div>
        <div class="container-inf">
            <img src="images/menu-farsh.jpg" alt="none" class="block-img">
            <div class="block-text">
                <h2>Меню</h2>
                <p>
                    Меню ресторана и карта вин продуманы до мелочей, а наши официанты помогут при заказе подобрать блюдо на любой вкус и посоветуют подходящие напитки.
                </p>
            </div>
        </div>
        <div class="container-inf">
            <div class="block-text">
                <h2>Продукты</h2>
                <p>
                    Мы используем только свежие продукты и работаем с проверенными партнерами - ведь именно качественные и свежие ингредиенты позволяют создавать настоящие кулинарные шедевры.
                </p>
            </div>
            <img src="images/fresh-products.jpg" alt="none" class="block-img">
        </div>
    </main>
    <!-- END -->
    <?php
        include("footer.php")
    ?>
</body>
</html>