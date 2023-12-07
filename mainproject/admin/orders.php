<?php
    session_start();
    if (isset($_SESSION["user"])){
        if ($_SESSION["user"]['is_admin']==0){
            header('Location: /');
            exit;
        }
    }
    else{
        header('Location: ../authorization.php');
        exit;
    }
    include('../database_conn.php');
    $errors = "";
    $query = "SELECT order_id, u.login as user, order_creation_date, order_arrival_date, price, addres
              FROM orders as o INNER JOIN users as u ON o.user_id = u.user_id";
    $result = mysqli_query($link,$query);

    $orders_arr = [];

    while ($order = mysqli_fetch_array($result)) {
        $orders_arr[$order['order_id']] = $order;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Products</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/admins.css'>
</head>
<body>
<?php
        include("header.php");
    ?>
    <main id='items-page'>
        <div class='main-content'>
            <table>
                <tr class='col_names'>
                    <td>id</td>
                    <td>Пользователь</td>
                    <td>Время создания</td>
                    <td>Время доставки</td>
                    <td>Цена</td>
                    <td>Адрес</td>
                </tr>

                <?php
                    foreach ($orders_arr as $order_id => $order) {
                        echo "<tr>
                        <td>{$order_id}</td>
                        <td>{$order['user']}</td>
                        <td>{$order['order_creation_date']}</td>
                        <td>{$order['order_arrival_date']}</td>
                        <td>{$order['price']}</td>
                        <td>{$order['addres']}</td>
                    </tr>";
                    }
                ?>
            </table>
        </div>
    </main>
</body>
</html>