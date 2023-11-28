<?php
    $message_error = "";
    if (isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['passwordSec']) && isset($_POST['first_name']) && isset($_POST['last_name'])){
        $email = $_POST['email'];
        $login = $_POST['login'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $passwordSec = $_POST['passwordSec'];
        if ($password != $passwordSec){
            $message_error = 'Пароли не совпадают';
        }
        else {
            include("database_conn.php");
            
            $query = "SELECT * FROM users WHERE login = '$login'";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) > 0){
                $message_error = "Данный логин уже занят";
            }
            else {
                $query = "INSERT INTO users (`login`, `password`, `first_name`, `last_name`, `email`) VALUES ('{$login}', '{$password}', '{$first_name}', '{$last_name}', '{$email}')";
                $result_query = mysqli_query($link, $query);
                if ($result_query){
                    session_start();
                    session_destroy();
                    session_start();
                    
                    $query = "SELECT * FROM users WHERE login = '$login'";
                    $result = mysqli_query($link, $query);
                    $user = mysqli_fetch_array($result);
                    $user_add["user_id"] = $user['user_id'];
                    $user_add["first_name"] = $user['first_name'];
                    $user_add["last_name"] = $user['last_name'];
                    $user_add["login"] = $user['login'];
                    $user_add["email"] = $user['email'];
                    $_SESSION["user"] = $user_add;
                    $_SESSION["shop_cart_count"] = 0;
                    header("Location: /user_page.php");
                    exit;
                }
                else{
                    $message_error ="Что-то пошло не так";
                }
            }
        }
    }
    else {
        $email = "";
        $login = "";
        $first_name = "";
        $last_name = "";
        $password = "";
        $passwordSec = "";
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
                <div class="errors"><?php echo $message_error;?></div>
                <input type="email" name="email" class="inp-text-auth" required placeholder="Почта" value="<?php echo $email; ?>">
                <input type="text" name="login" class="inp-text-auth"  maxlength="40" required placeholder="Логин" value="<?php echo $login; ?>">
                <input type="text" name="first_name" class="inp-text-auth" maxlength="40" required placeholder="Имя" value="<?php echo $first_name; ?>">
                <input type="text" name="last_name" class="inp-text-auth" maxlength="40" required placeholder="Фамилия" value="<?php echo $last_name; ?>">
                <input type="password" name="password" class="inp-text-auth" minlength="4" required placeholder="Пароль" value="<?php echo $password; ?>">
                <input type="password" name="passwordSec" class="inp-text-auth" required placeholder="Подтверждение пароля" value="<?php echo $passwordSec; ?>">

                <input type="submit" value="Регистрация" class="btn-sub-auth">
            </div>
            </form>
    </main>
</body>
</html>