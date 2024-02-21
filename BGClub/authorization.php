<?php
    session_start();
    if (isset($_SESSION["user"])){
        header("Location: /user_page.php");
        exit;
    }
?>
<?php
    session_start();
    session_destroy();
    $message_error = "";
    if (isset($_POST['login']) && isset($_POST['password'])){
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        include("database_conn.php");
        $query = "SELECT * FROM users WHERE login = '{$login}' OR email = '{$login}'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_array($result);
            if ($user["password"] == $password){
                session_start();
                $user_add["user_id"] = $user['user_id'];
                $user_add["first_name"] = $user['first_name'];
                $user_add["last_name"] = $user['last_name'];
                $user_add["login"] = $user['login'];
                $user_add["email"] = $user['email'];
                $user_add["is_admin"] = $user['is_admin'];
                $_SESSION["user"] = $user_add;
                $_SESSION["shop_cart_count"] = 0;
                if ($user["is_admin"] == 0){
                    header("Location: /user_page.php");
                    exit;
                }
                else{
                    header("Location: /admin/start_page.php");
                    exit;
                }
            } 
            else {
                $message_error = "Пароль неверный";
            }
        } 
        else {
            $message_error = "Пользователь не найден";
        }
    }
    else {
        $login = "";
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