<?php
    $menu_items = array(
		'Меню' => '/menu.php',
		'Акции' => '/sales.php',
		'Доставка' => '/delivery.php',
		'Контакты' => '/contacts.php',
        'Заказы' => '/orders.php',
	);

    session_start();
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['is_admin']==1){
            $menu_items['Администратор'] = '/adminV2/main_page.php';
        }
    }


    if (isset($_SESSION["user"]) && $_SESSION["shop_cart_count"] != 0){
        $shop_cart = $_SESSION["shop_cart_count"];
    }
    else{
        $shop_cart = "";
    }
?>

<header id="header">
        <div class="container-sizer">
            <div class="container-header">
                <a href="/" class="logo">BGCLUB</a>
                <div class="menu-content">
                    
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
                <div class="menu-icons">
                    <a href="/shop_cart.php" class="shop-cart"><?php echo $shop_cart;?></a>
                    <a href="/authorization.php" class="user"></a>
                </div>
            </div>
        </div>
    </header>