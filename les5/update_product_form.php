<?php
    include("db_conn.php");
?>
<?php
    $id = $_GET['pr_id'];
    $querry = "SELECT * FROM products WHERE product_id = {$id}";
	$result = mysqli_query($conn,$querry);
	$product = mysqli_fetch_array($result);
	if ($product==null){
		$message_err = "Даннго товара не существует.";
	} else{
		$message_err = "Изменить";
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
			<form action="/update_product_script.php" method="GET">
			<?php
			echo "
				<div align='center' class='form-title'>{$message_err}}</div><br>
				<span>Название</span><br>

				<input type='hidden' name='id' value={$id}>
				<input type='text' name='title' class='add-inp-text' value='{$product['title']}' required><br>
				<span>Цена</span><br>
				<input type='number' name='price' class='add-inp-text' value='{$product['price']}' required><br>
				<span>Количество</span><br>
				<input type='number' name='amount' class='add-inp-text' value='{$product['amount']}' required><br>
				";
				?>

				<input type="submit" value="Изменить" class="btn-sub-add">
				</div>
			</form>
		</div>
	</div>
</body>
</html>