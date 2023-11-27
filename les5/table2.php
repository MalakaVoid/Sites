<?php
	$link = mysqli_connect("localhost", "root", "root");
	mysqli_select_db($link,"db1");
	mysqli_set_charset($link,"utf8");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Table2</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
		include "menu.php";
	?>
	<div class="main-content">
        <div id="container-db-op">
            <a href='/add_product1.php'>Добавить</a>
            <a href='/update_product1.php'>Изменить</a>
            <a href='/delete_product1.php'>Удалить</a>
        </div>

		<table align="center" class="products-table" border="1"> 
			<tr>
				<td>№</td>
                <td>id</td>
				<td>Название</td>
				<td>Цена</td>
				<td>Количество</td>
				<!-- <td>Пользователь</td> -->
			</tr>
			<?php
			// ----------------------------------------------------
				$counter = 1;
				$querry = "SELECT * FROM products ";
				// echo $querry;
				$result_table = mysqli_query($link,$querry);

				while($product = mysqli_fetch_array($result_table))
				{
					echo "<tr>
							<td>{$counter}</td>
                            <td>{$product['product_id']}</td>
							<td>{$product['title']}</td>
							<td>{$product['price']}</td>
							<td>{$product['amount']}</td>
						</tr>";
					$counter++;
				}
			// -------------------------------------------------------
			?>
		</table>
	</div>
</body>
</html>