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
			<form action="/add_product_script.php" method="GET">
				<div align="center" class="form-title">Добавить товар</div><br>
				<span>Название</span><br>
				<input type="text" name="title" class="add-inp-text" required><br>
				<span>Цена</span><br>
				<input type="number" name="price" class="add-inp-text" required><br>
				<span>Количество</span><br>
				<input type="number" name="amount" class="add-inp-text" required><br>

				<input type="submit" value="Добавить" class="btn-sub-add">
				</div>
			</form>
		</div>
	</div>
</body>
</html>