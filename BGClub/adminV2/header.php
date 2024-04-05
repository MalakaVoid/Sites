<?php
    $menu_items = array(
        'Главная' => '/adminV2/main_page.php',
		'Пользователи' => '/adminV2/users_page.php',
		'Товары' => '/adminV2/products_page.php',
		'Заказы' => '/adminV2/orders_page.php',
	);
?>

<header id="header">
        <div class="container-sizer">
            <div class="container-header">

            <?php
                foreach ($menu_items as $title => $url) {
                    if ($_SERVER['REQUEST_URI'] == $url) {
                        echo "<a href='{$url}' class='menu active'>{$title}</a>";
                    }
                    else {
                        echo "<a href='{$url}' class='menu'>{$title}</a>";
                    }
                }
            ?>
            </div>
        </div>
    </header>