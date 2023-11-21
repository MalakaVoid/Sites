<!DOCTYPE html>
<html>
<head>
	<title>Меню</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="wrapper">
		<?php 
			include 'menu.php';
	 	?>
	 	<div class="main-content">
	 		<h1 align="center">Меню</h1>
	 		<hr class="main-hr devider">
	 		<?php
				include 'products_creation.php';
	 		?>
	 	</div>
	 </div>
</body>
</html>