<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: /authorization.php");
        exit;
    }
    if (isset($_POST['exit'])){
        session_destroy();
        header('Location: /authorization.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Menu</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/header_footer.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main id="container-user-page">
        <div>
            <h1 class="title-page-acc">АККАУНТ</h1>
            <?php
                $user_inf = $_SESSION['user'];
                foreach ($user_inf as $key => $value) {
                    $field = "";
                    if ($key == 'login'){
                        $field = 'Логин';
                    }
                    else if ($key == 'first_name'){
                        $field = 'Имя';
                    }
                    else if ($key == 'last_name'){
                        $field = 'Фамилия';
                    }
                    else if ($key == 'email'){
                        $field = 'Email';
                    }
                    if ($field != ""){
                        echo "<div>
                                    {$field}:
                                </div>
                                <div class='user'>
                                    {$value}
                                </div>";
                    }

                }
            ?>
            
            <form action='/user_page.php' method='POST'>
                <input type="submit" name='exit' value='Выйти'>
            </form>
            
        
        </div>
    </main>
    <?php
        include("footer.php");
    ?>
</body>
</html>