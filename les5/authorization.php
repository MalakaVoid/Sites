<?php
    session_start();
    session_destroy();
    $errors = "";
    if (isset($_POST["login"])) {
        $link = mysqli_connect("localhost", "root", "root");
	    mysqli_select_db($link,"db1");
	    mysqli_set_charset($link,"utf8");

        $querry = "SELECT * FROM users WHERE login = '{$_POST['login']}'";
		$result_query = mysqli_query($link,$querry);

        $user = mysqli_fetch_array($result_query);
        if ($user != null) {
            if ($user["password"] == $_POST['password']) {
                session_start();
                // START OF SESSION
                $_SESSION["user_fio"] = $user["name"];
                $_SESSION["user_login"] = $user["login"];
                $_SESSION["user_id"] = $user["user_id"];
                header ('Location: /');
                exit;
            } else {
                $errors = 'Неверный пароль';
            }
        } else{
            $errors = 'Пользователь не найден';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Authorization</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
    <div class="main-content-auth">
        <div class="authorization-form" align="center">
            <form method="POST" action="/authorization.php">
                <span class="title-auth">Авторизация</span><br>

                <input type="text" name="login" class="inp-text-auth" required placeholder="Логин"><br>
                <input type="text" name="password" class="inp-text-auth" required placeholder="Пароль"><br>

                <div class="error-msg-auth">
                    <?php 
                        echo $errors;
                    ?>
                </div>
                <input type="submit" value="Войти" class="btn-sub-auth">
                <a href="registration.php">Регистрация</a>
            </form>
        </div>
    </div>
    
</body>
</html>