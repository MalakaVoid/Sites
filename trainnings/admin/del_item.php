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
	 		<form action="del_item_from_json.php" method="GET" class='add_item_form'>
	 			<h2 align="center">Удалить</h2>
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
	 			<select name='title' class='type_inp' required>
	 				<option></option>
	 				<?php
	 					foreach ($items as $value) {
	 						echo "<option>{$value}</option>";
	 					}
	 				?>
	 			</select>
	 			<!-- <input type="text" name="title" class='inp_text' maxlength="30" required> -->
	 			<br>
	 			
	 			<input type="submit" class='sub_item_btn' value="Удалить">
	 		</form>
	 		</div>
	 	</div>
	 </div>
</body>
</html>