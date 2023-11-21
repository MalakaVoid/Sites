<?php 
	include 'get_all_items.php';

	$is_item_exists = isset($products[$_GET['type']][$_GET['category']][$_GET['title']]);

	if ($is_item_exists){

		$helper_arr = $products[$_GET['type']][$_GET['category']][$_GET['title']];

		unset($products[$_GET['type']][$_GET['category']][$_GET['title']]);

		$a = json_encode($products, JSON_UNESCAPED_UNICODE);
		file_put_contents("../products.json", $a);

		$message_to_user = "Элемент успешно удален.";
	} else {
		$helper_arr = null;
		$message_to_user = "Данного товара не существует.";
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Добавлен Элемент</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<div id="wrapper">
		<?php 
			include 'admin_menu.php';
	 	?>

	 	<div class="main-content" align="center">
	 		<?php
	 		echo "<h1>{$message_to_user}</h1>";
	 		if ($is_item_exists){
	 		echo "<div class='pr-card'>
 					<div class='img-product-box' align='center'>
 						<img src='../{$helper_arr['img']}'>
 					</div>
 					<div class='price' align='left'>
	 					<span>{$helper_arr['price']} ₽</span>
	 				</div>
	 				<div class='title' align='left'>
	 					<span>{$_GET['title']}</span>
	 				</div>
	 			</div>";
	 		};
	 		?>
	 	</div>
	 </div>
</body>
</html>