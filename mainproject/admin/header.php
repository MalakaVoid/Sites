<?php
    $menu_items = array(
        'Главная' => '/admin/start_page.php',
		'Пользователи' => '/admin/users.php',
		'Товары' => '/admin/products.php',
		'Заказы' => '/admin/orders.php',
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