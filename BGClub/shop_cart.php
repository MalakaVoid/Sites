<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: /authorization.php");
    }
    if (isset($_POST['add_item'])){
        $added_item = $_POST['add_item'];
        $_SESSION['shop_cart'][$added_item]+=1;
        $_SESSION["shop_cart_count"]+=1;
    }
    if (isset($_POST['del_item'])){
        $deleted_item = $_POST['del_item'];
        if ($_SESSION['shop_cart'][$deleted_item]==1){
            unset($_SESSION['shop_cart'][$deleted_item]);
        } else{
            $_SESSION['shop_cart'][$deleted_item]-=1;
        }
        $_SESSION["shop_cart_count"]-=1;
    }
    include("database_conn.php");

    if (isset($_SESSION['shop_cart']) && count($_SESSION['shop_cart'])>0){
        $empty_flag = false;  
        $cart_items = [];
        foreach ($_SESSION['shop_cart'] as $key => $value){
            $querry = "SELECT * FROM items WHERE item_id = {$key}";
            $result_query_item = mysqli_query($link,$querry);
            $item = mysqli_fetch_array($result_query_item);
            if ($item != null){
                $cart_items[$item['item_id']] =array(
                    'count'=> $value,
                    'title'=> $item['title'],
                    'desc'=> $item['description'],
                    'price'=> $item['price'],    
                    'img' => $item['img']                
                ) ;
            }
        }

        $sum_price = 0;
        foreach ($cart_items as $item_id => $info){
            $sum_price += $info["price"]*$info['count'];
        }
    }
    else{
        $empty_flag = true;
        $empty_text = "<h2 class='empty'>Тут пусто</h2>";
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
                <?php
                    if ($empty_flag){
                        echo $empty_text;
                    }
                    else{
                        foreach ($cart_items as $item_id => $info){
                            echo "
                            <div class='card'>
                                <div class='left-side'>
                                    <img src='{$info['img']}' alt='Burger1'>
                                    <div class='info'>
                                        <h2>{$info['title']}</h2>
                                        {$info['desc']}
                                    </div>
                                    
                                </div>
                                <div class='amount'>
                                    {$info['count']}
                                </div>
                                <div class='right-side'>
                                    <div class='price'>
                                        {$info['price']} P
                                    </div>
                                    <div class='add_dell_el'>
                                        <form method='POST' action='/shop_cart.php'>
                                            <button type='submit' name='add_item' value='{$item_id}'>+</button>
                                            <button type='submit' name='del_item' value='{$item_id}'>&ndash;</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            ";
                        }
                    }
                ?>
            </div>
            <?PHP if (!$empty_flag){
            echo"        
            <hr>
            <div class='shop-cart-summ'>
                <div class='summ'>
                    <div>
                        CУММА ЗАКАЗА: 
                    </div>
                    <div>
                        {$sum_price} P
                    </div>
                </div>
                <form method='POST' action='/payment.php'>
                <div class='btn-container'>
                    <input type='text' name='addres' placeholder='Введите адресс доставки' required>
                    <button class='order_btn' type='submit' value='1'>Заказать</button>
                </div>
                </form>
            </div>
                ";}?>
        </div>
    </main>
    <?php
        include("footer.php");
    ?>
</body>
</html>