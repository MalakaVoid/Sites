<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Menu</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/authorization-registration.css'>
</head>
<body>
    <main>
        <!-- <div class="authorization-container"> -->
            <form method="post" action="/menu">
            <div class="authorization-container">
                <div class="container-links">
                    <a href="/authorization.php">ВХОД</a>
                    <a href="/registration.php" class='active'>РЕГИСТРАЦИЯ</a>
                </div>
                <input type="text" name="login" class="inp-text-auth" required placeholder="Логин">
                <input type="password" name="password" class="inp-text-auth" required placeholder="Пароль">

                <div class="error-msg-auth">
                    <?php 
                        echo $errors;
                    ?>
                </div>
                <input type="submit" value="Войти" class="btn-sub-auth">
            </div>
            </form>
        <!-- </div> -->
    </main>
</body>
</html>