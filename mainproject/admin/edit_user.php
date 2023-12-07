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
    if (isset($_POST["user_id"])){
        $user_id = $_POST["user_id"];
        $query = "SELECT * from users WHERE user_id={$user_id}";
        $result = mysqli_query($link, $query);
        $user = mysqli_fetch_array($result);
        $login = $user['login'];
        $password = $user['password'];
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $email = $user['email'];
        $is_admin = $user['is_admin'];
    }
    else{
        header('Location: /admin/user.php');
    }

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
        
        $query = "UPDATE users SET login='{$login}', password = '{$password}', first_name='{$first_name}', last_name='{$last_name}', email='{$email}', is_admin={$is_admin} WHERE user_id={$user_id}";
        $result = mysqli_query($link, $query);
        if ($result){
            $errors = 'Запись успешно изменена.';
        }
        else{
            $errors = 'Что-то пошло не так.';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Edit user</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/admins.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>   
    <main id='edit-user-page'>
        <form action='/admin/edit_user.php' method='POST'>
            <div class='container-form'>
                <h1>Изменить пользователя</h1>
                <?php
                    if ($errors != ""){
                        echo "<div class='errors'>
                        {$errors}
                            </div>";
                    }
                    $checked = "";
                    if ($is_admin==1){
                        $checked = "checked";
                    }
                    echo "<input type='text' name='login' placeholder='Логин' required value='{$login}'>
                    <input type='text' name='password' placeholder='Пароль' required value='{$password}'>
                    <input type='text' name='first_name' placeholder='Имя' required value='{$first_name}'>
                    <input type='text' name='last_name' placeholder='Фамилия' required value='{$last_name}'>
                    <input type='email' name='email' placeholder='Email' required value='{$email}'>
                    <div>
                        <input type='checkbox' name='is_admin' {$checked}> Администратор
                    </div>
                    <input type='hidden' name='user_id' value={$user_id}>
                    <button type='submit'>Изменить</button>";
                ?>
            </div>
        </form>
    </main>
</body>
</html>