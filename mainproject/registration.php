<?php
    $message_error = "";
    if (isset($_SESSION['email']) && isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['passwordSec'])){
        $email = $_SESSION['email'];
        $login = $_SESSION['login'];
        $password = $_SESSION['password'];
        $passwordSec = $_SESSION['passwordSec'];
        if ($password != $passwordSec){
            $message_error = 'Пароли не совпадают';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Menu</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/header_footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/authorization-registration.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main>
            <form method="post" action="/registration.php">
            <div class="authorization-container">
                <div class="container-links">
                    <a href="/authorization.php" class='active'>ВХОД</a>
                    <a href="/authorization.php">РЕГИСТРАЦИЯ</a>
                </div>
                <div class="errors">
                    <?php echo $message_error;?>
                </div>
                <input type="email" name="email" class="inp-text-auth" required placeholder="Почта">
                <input type="text" name="login" class="inp-text-auth" required placeholder="Логин">
                <input type="password" name="password" class="inp-text-auth" required placeholder="Пароль">
                <input type="password" name="passwordSec" class="inp-text-auth" required placeholder="Подтверждение пароля">

                <input type="submit" value="Регистрация" class="btn-sub-auth">
            </div>
            </form>
    </main>
</body>
</html>