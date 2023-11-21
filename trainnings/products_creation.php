<?php
	$tmp = file_get_contents("products.json");
	$products = json_decode($tmp, true);
	foreach ($products as $group => $arr_categoryes) {
		echo "<span class='pr-type'>{$group}</span>";
	 	echo "<hr class='devider'>";

	 	foreach ($arr_categoryes as $category => $arr_products) {
	 		echo "<span class='pr-cat'>{$category}</span>
	 		<br>";
	 		foreach ($arr_products as $product => $pr_img_price) {
	 			echo "<div class='pr-card'>
	 					<div class='img-product-box' align='center'>
 							<img src='{$pr_img_price['img']}'>
 						</div>
 						<div class='price'>
	 						<span>{$pr_img_price['price']} ₽</span>
	 					</div>
	 					<div class='title' align='left'>
	 						<span>{$product}</span>
	 					</div>
	 				</div>";
	 		};
	 		echo '<br>';
	 	};
	 	//echo "<hr class='devider'>";
	 	echo "<br>";
	};

	
 ?>
