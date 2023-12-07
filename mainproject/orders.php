<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: /authorization.php");
    }
    include("database_conn.php");

    $querry = "SELECT * FROM orders WHERE user_id = {$_SESSION['user']['user_id']} ORDER BY order_creation_date DESC LIMIT 10";
    $orders_query = mysqli_query($link,$querry);
    $output_order = [];
    $price = 0;
    while ($order = mysqli_fetch_array($orders_query)){
        $output_order[$order['order_id']]['price'] = $order['price'];
        $output_order[$order['order_id']]['addres'] = $order['addres'];
        $output_order[$order['order_id']]['order_creation_date'] = $order['order_creation_date'];
        $output_order[$order['order_id']]['order_arrival_date'] = $order['order_arrival_date'];


        $querry = "SELECT item_id, amount FROM order_items WHERE order_id = {$order['order_id']}";
        $item_ids_query = mysqli_query($link,$querry);
        while ($item_order = mysqli_fetch_array($item_ids_query)){
            $querry = "SELECT item_id,title FROM items WHERE item_id = {$item_order['item_id']}";
            $items_query = mysqli_query($link,$querry);
            $item = mysqli_fetch_array($items_query);
            $output_order[$order['order_id']]['items'][$item['item_id']]['title']= $item['title'];
            $output_order[$order['order_id']]['items'][$item['item_id']]['amount']= $item_order['amount'];
        }
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
    <main id="orders-page">
        <div class='orders-container'>
            <h1>ЗАКАЗЫ</h1>
            <?php
                foreach ($output_order as $order_id => $info) {
                    echo "<div class='order-container'>
                          Товары:";
                          echo "<div>";
                    foreach ($info['items'] as $item_id => $item_info) {
                        echo "{$item_info['title']} x{$item_info['amount']}<br>";
                    }
                    echo "</div>
                        Цена:
                        <div>
                        {$info['price']} P
                        </div>
                        Создан:
                        <div>
                        {$info['order_creation_date']}
                        </div>
                        Время доставки:
                        <div>
                        {$info['order_arrival_date']}
                        </div>
                        Адрес:
                        <div>
                        {$info['addres']}
                        </div>
                    </div>";
                }

            ?>
        </div>
    </main>
    <?php
        include("footer.php");
    ?>
</body>
</html>