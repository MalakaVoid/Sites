<?php
    $message_error = "";
    if (isset($_POST['login']) && isset($_POST['password'])){
        $login = $_POST['login'];
        $password = $_POST['password'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Menu</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/header_footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/authorization-registration.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main>
            <form method="post" action="/authorization.php">
            <div class="authorization-container">
                <div class="container-links">
                    <a href="/authorization.php">ВХОД</a>
                    <a href="/registration.php" class='active'>РЕГИСТРАЦИЯ</a>
                </div>
                <div class="errors">
                    <?php echo $message_error;?>
                </div>
                <input type="text" name="login" class="inp-text-auth" required placeholder="Логин">
                <input type="password" name="password" class="inp-text-auth" required placeholder="Пароль">

                <input type="submit" value="Войти" class="btn-sub-auth">
            </div>
            </form>
    </main>
</body>
</html>