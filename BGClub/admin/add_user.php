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
    $login = "";
    $password = "";
    $first_name = "";
    $last_name = "";
    $email = "";
    if (isset($_POST['login'])){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $is_admin = 0;
        if (isset($_POST['is_admin'])){
            $is_admin = 1;
        }

        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0){
            $errors = "Данный логин уже занят";
        }
        else{
            $query = "INSERT INTO users (`login`, `password`, `first_name`, `last_name`, `email`, is_admin) 
                    VALUES ('{$login}', '{$password}', '{$first_name}', '{$last_name}', '{$email}', {$is_admin})";
            $result_query = mysqli_query($link, $query);
            // echo $result_query;
            if ($result_query){
                $errors = "Новый пользователь успешно добавлен";
                $login = "";
                $password = "";
                $first_name = "";
                $last_name = "";
                $email = "";
            }
            else{
                $errors = "Что-то пошло не так! Попробуйте еще раз.";
            }
        }
        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Add User</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/admins.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>   
    <main id='users-add-page'>
        <form action='/admin/add_user.php' method='POST'>
            <div class='container-form'>
                <h1>Добавить пользователя</h1>
                <?php
                    if ($errors != ""){
                        echo "<div class='errors'>
                        {$errors}
                            </div>";
                    }
                    echo "<input type='text' name='login' placeholder='Логин' required value='{$login}'>
                    <input type='text' name='password' placeholder='Пароль' required value='{$password}'>
                    <input type='text' name='first_name' placeholder='Имя' required value='{$first_name}'>
                    <input type='text' name='last_name' placeholder='Фамилия' required value='{$last_name}'>
                    <input type='email' name='email' placeholder='Email' required value='{$email}'>
                    <div>
                        <label>
                            <input type='checkbox' name='is_admin'> <span></span>
                            Администратор
                        </label>
                    </div>
                    <button type='submit'>Добавить</button>";
                ?>
            </div>
        </form>
    </main>
</body>
</html>