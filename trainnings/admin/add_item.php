<?php
	include 'get_all_items.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Добавить Товар</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<div id="wrapper">
		<?php 
			include 'admin_menu.php';
	 	?>
	 	<div class="main-content" align="center">
	 		<div class='div_form_add'>
	 		<form action="add_item_to_json.php" method="GET" class='add_item_form'>
	 			<h2 align="center">Добавить товар</h2>
	 			Тип товара<br>
	 			<select name='type' class='type_inp'>
	 			<?php
	 				foreach ($types as $value) {
	 					echo "<option>{$value}</option>";
	 				}
	 			?>
	 			</select>
	 			<br>
	 			Категория товара <br>
	 			<select name='category' class='type_inp'>
	 				<?php
	 					foreach ($categoryes as $value) {
	 						echo "<option>{$value}</option>";
	 					}
	 				?>
	 			</select>
	 			<br>
	 			Название товара
	 			<br>
	 			<input type="text" name="title" class='inp_text' maxlength="30" required>
	 			<br>
	 			Цена
	 			<br>
	 			<input type="number" name="price" class='inp_text' maxlength="10" placeholder="100" required>
	 			<br>
	 			Картинка
	 			<br>
	 			<input type="text" name="image" class='inp_text' maxlength="30" placeholder="images/different.png" value="images/different.png">
	 			<br>
	 			<input type="submit" class='sub_item_btn' value="Добавить">
	 		</form>
	 		</div>
	 	</div>
	 </div>
</body>
</html>