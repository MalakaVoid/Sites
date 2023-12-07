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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Start Page</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/admins.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main id='start-page'>
        <h1 class='title-page'>Добро пожаловать в панель администратора!</h1>
        <p>
            Тут вы можете добавлять, изменять и удалять пользователей, товары и заказы пользователей.
        </p>
        <ul>
            <li>
                Для <b>ПРОСМОТРА УДАЛЕНИЯ ИЗМЕНЕНИЯ ДОБАВЛЕНИЯ</b> пользователей перейдите во вкладку с <b>пользователями</b>.
            </li>
            <li>
                Для <b>ПРОСМОТРА УДАЛЕНИЯ ИЗМЕНЕНИЯ ДОБАВЛЕНИЯ</b> товаров перейдите во вкладку с <b>товарами</b>.
            </li>
            <li>
                Для <b>ПРОСТМОТРА</b> заказов пользователей перейдите во вкладку с <b>заказми</b>.
            </li>
        </ul>
        
        <div class='btn-container'>
            <form action='/authorization.php' method='POST'>
                <button type="submit">Выйти</button>
            </form>
        </div>
    </main>
</body>
</html>