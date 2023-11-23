<?php
    $menu_items = array(
		'Меню' => '/menu.php',
		'Акции' => '/sales.php',
		'Доставка' => '/delivery.php',
		'Контакты' => '/contacts.php',
	);
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
                    <a href="/" class="shop-cart">1</a>
                    <a href="/authorization.php" class="user"></a>
                </div>  
            </div>
        </div>
    </header>