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
    if (isset($_POST['item_id'])){
        $query = "DELETE FROM items WHERE item_id={$_POST['item_id']}";
        $result = mysqli_query($link, $query);
        if ($result){
            $errors = 'Товар успешно удален';
        }
        else{
            $errors = 'Что то пошло не так при удалении пользователя.';
        }

        unset($_POST['item_id']);
    }

    $query = "SELECT item_id, title, description, price, sale, c.name as category FROM items as i INNER JOIN category as c ON i.category = c.category_id";
    $result = mysqli_query($link,$query);

    $items_arr = [];

    while ($item = mysqli_fetch_array($result)) {
        $items_arr[$item['item_id']] = $item;
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
            <div class='errors'>
            <?php
                echo $errors;
            ?>
            </div>
            <div class='add_btn_container'>
                <form action='/admin/add_item.php' method='GET'>
                    <button type='submit'>Добавить товар</button>
                </form>
            </div>
            <table>
                <tr class='col_names'>
                    <td>id</td>
                    <td>Название</td>
                    <!-- <td>Описание</td> -->
                    <td>Цена</td>
                    <td>Тип</td>
                    <td>Акция</td>
                </tr>

                <?php
                    foreach ($items_arr as $item_id => $item) {
                        echo "<tr>
                        <td>{$item_id}</td>
                        <td>{$item['title']}</td>
                        <td>&nbsp;{$item['price']}&nbsp;</td>
                        <td>{$item['category']}</td>
                        <td>{$item['sale']}</td>
                        <td><form action='/admin/edit_item.php' method='POST'><button type='submit' name='item_id' value='{$item_id}'>Edit</button></form></td>
                        <td><form action='/admin/products.php' method='POST'><button type='submit' name='item_id' value='{$item_id}'>Delete</button></form></td>
                    </tr>";
                    }
                ?>
            </table>
        </div>
    </main>
</body>
</html>