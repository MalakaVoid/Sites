<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header ('Location: /authorization.php');
        exit;
      }
?>
<?php
	$link = mysqli_connect("localhost", "root", "root");
	mysqli_select_db($link,"db1");
	mysqli_set_charset($link,"utf8");
	$errors = "";

	if (isset($_POST["title"])) {
		$querry = "INSERT INTO products(title, price, amount, user) VALUES ('{$_POST['title']}', {$_POST['price']}, {$_POST['amount']}, {$_POST['user_id']})";
		$result_query = mysqli_query($link,$querry);
		if ($result_query == 1){
			$errors = "Новый товар успешно добавлен";
		} else{
			$errors = "Что то пошло не так";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add product</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
		include "menu.php";
	?>
	<div class="main-content" align="center">
		<div class="add_pr_form" align="left">
			<form action="/add_product.php" method="POST">
				<div align="center" class="form-title">Добавить товар</div><br>
				<span>Название</span><br>
				<input type="text" name="title" class="add-inp-text" required><br>
				<span>Цена</span><br>
				<input type="number" name="price" class="add-inp-text" required><br>
				<span>Количество</span><br>
				<input type="number" name="amount" class="add-inp-text" required><br>
				<?php
				echo "<input type='hidden' name='user_id' value='{$_SESSION['user_id']}'>";
				?>
				<div align="center">
				<span class="error-msg">
				<?php
				echo $errors;
				?></span><br>
				<input type="submit" value="Добавить" class="btn-sub-add">
				</div>
			</form>
		</div>
	</div>
</body>
</html>