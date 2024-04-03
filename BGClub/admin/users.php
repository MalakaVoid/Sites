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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Users</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/admins.css'>
</head>
<body>
<?php
        include("header.php");
    ?>
    <main id='users-page'>
        <div class='main-content'>
            <div class='errors'>
            <?php
                echo $errors;
            ?>
            </div>
            <div class='add_btn_container'>
                <form action='/admin/add_user.php' method='GET'>
                    <button type='submit'>Добавить пользователя</button>
                </form>
            </div>
            <table id="users_table">
                <tr class='col_names'>
                    <td>id</td>
                    <td>Логин</td>
                    <td>Пароль</td>
                    <td>Имя</td>
                    <td>Фамилия</td>
                    <td>Email</td>
                    <td>админ</td>
                </tr>

                <?php
                    // foreach ($users_arr as $user_id => $user) {
                    //     echo "<tr>
                    //     <td>{$user_id}</td>
                    //     <td>{$user['login']}</td>
                    //     <td>{$user['password']}</td>
                    //     <td>{$user['first_name']}</td>
                    //     <td>{$user['last_name']}</td>
                    //     <td>{$user['email']}</td>
                    //     <td>{$user['is_admin']}</td>
                    //     <td><form action='/admin/edit_user.php' method='POST'><button type='submit' name='user_id' value='{$user_id}'><img src='../images/edit.png'></button></form></td>
                    //     <td><form action='/admin/users.php' method='POST'><button type='submit' name='user_id' value='{$user_id}'><img src='../images/bin.png'></button></form></td>
                    // </tr>";
                    // }
                ?>
            </table>
        </div>
    </main>

    <script src="./scripts/jq.js"></script>
    <script src="./scripts/delete_user.js"></script>
    <script src="./scripts/get_users.js"></script>
</body>
</html>