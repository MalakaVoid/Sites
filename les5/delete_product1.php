<?php
	include("db_conn.php")
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
        <form action='/del_items_script.php' method='GET' class='del-form'>
		<table align="center" class="products-table" border="1"> 
			<tr>
                <td>delete</td>
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
				$result_table = mysqli_query($conn,$querry);

				while($product = mysqli_fetch_array($result_table))
				{
					echo "<tr>
                            <td><input type='checkbox' name='del_ids[]' value='{$product['product_id']}'></td>
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
			<input type="submit" value='Удалить' class='back_btn'>
        </form>
	</div>
</body>
</html>