<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header ('Location: /authorization.php');
        exit;
      }
?>
<?php
	$link = mysqli_connect("localhost", "root", "root");
	mysqli_select_db($link,"db1");
	mysqli_set_charset($link,"utf8");

	if(isset($_GET['sort'])){
		$sort=$_GET['sort'];
	} else {
		$sort = null;
	}

	switch ($sort) {
		case 1:
			$sort_text = "ORDER BY price DESC";
			break;
		case 2:
			$sort_text = "ORDER BY price";
			break;
		case 3:
			$sort_text = "ORDER BY title DESC";
			break;
		case 4:
			$sort_text = "ORDER BY title";
			break;
		default:
			$sort_text = "ORDER BY title";
	}

	$where_cond = "WHERE user = {$_SESSION['user_id']} ";

	if (isset($_POST["start"]) and isset($_POST['end'])){
		if ($_POST['start'] != "" and $_POST['end'] != ""){
			$where_cond .= "AND price BETWEEN {$_POST['start']} AND {$_POST['end']}";
		}
		else if ($_POST['start'] != ""){
			$where_cond .= "AND price >= {$_POST['start']}";
		}
		else if ($_POST['end'] != ""){
			$where_cond .= "AND price <= {$_POST['end']}";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
		include "menu.php";
	?>
	<div class="main-content">
		<table align="center" class="products-table" border="1"> 
			<tr>
				<td>№</td>
				<td>Название <a href="/table.php?sort=3">↑</a><a href="/table.php?sort=4">↓</a></td>
				<td>Цена <a href="/table.php?sort=1">↑</a><a href="/table.php?sort=2">↓</a></td>
				<td>Количество</td>
				<td>Пользователь</td>
			</tr>
			<?php
			// ----------------------------------------------------
				$counter = 1;
				$querry = "SELECT * FROM products {$where_cond} {$sort_text}";
				// echo $querry;
				$result_table = mysqli_query($link,$querry);

				while($product = mysqli_fetch_array($result_table))
				{
					echo "<tr>
							<td>{$counter}</td>
							<td>{$product['title']}</td>
							<td>{$product['price']}</td>
							<td>{$product['amount']}</td>
							<td>{$product['user']}</td>
						</tr>";
					$counter++;
				}
			// -------------------------------------------------------
			?>
		</table>
		<div class="form-sort">
			<form action="/table.php" method="POST">
				<span class="form-title" align="center">Цена</span><br>
				от<br>
				<input type="number" name="start" class="inp-text"><br>
				до<br>
				<input type="number" name="end" class="inp-text"><br>
				<input type="submit" value="Сортировать" class="btn-sub">
			</form>
		</div>
	</div>
</body>
</html>