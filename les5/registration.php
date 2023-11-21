<?php
    session_start();
    session_destroy();
    $errors = "";
    if (isset($_POST["login"])) {
        $link = mysqli_connect("localhost", "root", "root");
	    mysqli_select_db($link,"db1");
	    mysqli_set_charset($link,"utf8");

        $querry = "SELECT login, password FROM users WHERE login = '{$_POST['login']}'";
		$result_query = mysqli_query($link,$querry);

        $user = mysqli_fetch_array($result_query);
        if ($user == null) {
            $querry = "INSERT INTO users(name, login, password) VALUES ('{$_POST['fio']}', '{$_POST['login']}', '{$_POST['password']}')";
            $result_query = mysqli_query($link,$querry);
            if ($result_query == 1){
                session_start();
                //START OF SESSION
                $querry_select = "SELECT * FROM users WHERE login = '{$_POST['login']}'";
		        $result_query_select = mysqli_query($link, $querry_select);

                $user = mysqli_fetch_array($result_query_select);

                $_SESSION["user_fio"] = $user["name"];
                $_SESSION["user_login"] = $user["login"];
                $_SESSION["user_id"] = $user["user_id"];
                header("Location: /");
                exit;
            } else {
                $errors = "Что то пошло не так";
            }
        } else {
            $errors = "Выберите другой логин";
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
        <div class="registration-form" align="center">
            <form method="POST" action="/registration.php">
                <span class="title-auth">Регистрация</span><br>

                <input type="text" name="fio" class="inp-text-auth" required placeholder="ФИО"><br>
                <input type="text" name="login" class="inp-text-auth" required placeholder="Логин"><br>
                <input type="text" name="password" class="inp-text-auth" required placeholder="Пароль"><br>

                <div class="error-msg-auth">
                    <?php 
                        echo $errors;
                    ?>
                </div>
                <input type="submit" value="Регистрация" class="btn-sub-auth">
            </form>
        </div>
    </div>
    
</body>
</html>