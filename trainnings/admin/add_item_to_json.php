<?php
	$tmp = file_get_contents("../products.json");
	$products = json_decode($tmp, true);

	$products[$_GET['type']][$_GET['category']][$_GET['title']] = [
		'price' => $_GET['price'],
		'img' => $_GET['image']
	];

	$a = json_encode($products, JSON_UNESCAPED_UNICODE);
	file_put_contents("../products.json", $a);
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
	 		<h1>Элемент успешно добавлен.</h1>
	 		<div class='pr-card'>
 						<?php
 						echo "<div class='img-product-box' align='center'>
 							<img src='../{$_GET['image']}'>
 						</div>
 						<div class='price' align='left'>
	 						<span>{$_GET['price']} ₽</span>
	 					</div>
	 					<div class='title' align='left'>
	 						<span>{$_GET['title']}</span>
	 					</div>"
	 					?>
	 				</div>
	 	</div>
	 </div>
</body>
</html>