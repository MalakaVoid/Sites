<?php
    include("database_conn.php");
    session_start();

    if (!isset($_POST["addres"])) {
        header("Location: /shop_cart.php");
        exit;
    }
    // var_dump($_SESSION);
    if (isset($_SESSION['shop_cart']) && count($_SESSION['shop_cart'])>0){
        $cart_items = [];
        $sum_price = 0;
        foreach ($_SESSION['shop_cart'] as $item_id => $amount){
            $querry = "SELECT price FROM items WHERE item_id = {$item_id}";
            $result_query_item = mysqli_query($link,$querry);
            $item = mysqli_fetch_array($result_query_item)['price'];
            $sum_price += $item*$amount;
            echo $item*$amount;
        }        

        $now = new DateTime('now');
        $creation_date = date_format($now,'Y-m-d H:i:s');
        $hour = date_modify($now, "+1 hour");
        $arrival_date = date_format($hour,'Y-m-d H:i:s');
        $query = "INSERT INTO orders(user_id, order_creation_date, order_arrival_date, price, addres)
                  VALUES ({$_SESSION['user']['user_id']}, '{$creation_date}', '{$arrival_date}', {$sum_price}, '{$_POST["addres"]}')";
        $result_query = mysqli_query($link,$query);
        echo $result_query;


        $query = "SELECT order_id FROM orders WHERE user_id={$_SESSION['user']['user_id']} ORDER BY order_id DESC";
        $result_query = mysqli_query($link,$query);
        $order_id = mysqli_fetch_array($result_query)['order_id'];

        foreach ($_SESSION['shop_cart'] as $item_id => $amount){
            $querry = "INSERT INTO order_items(order_id, item_id, amount) VALUES ({$order_id}, {$item_id}, {$amount})";
            $result_query_item = mysqli_query($link,$querry);
        }
        unset($_SESSION['shop_cart']);
        $_SESSION['shop_cart_count'] = 0;
        header('Location: /orders.php');
        exit;

    } else{
        header('Location: /shop_cart.php');
        exit;
    }
?>