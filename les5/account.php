<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header ('Location: /authorization.php');
        exit;
      }
?>
<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
		include "menu.php";
	?>
	<div class="main-content">
		<div class="user-card" align="center">
            <table>
            <?php
                echo "<tr>
                        <td>Имя</td>
                        <td>{$_SESSION['user_fio']}</td>
                    </tr>";
                echo "<tr>
                    <td>Логин</td>
                    <td>{$_SESSION['user_login']}</td>
                </tr>";
            ?>
            </table>
            <a href="/authorization.php" class="exit-acc-btn">Выйти</a>
        </div>
	</div>
</body>
</html>