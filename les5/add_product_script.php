<?php
    include("db_conn.php");
?>
<?php
    if (isset($_GET['title']) AND $_GET['price'] AND $_GET['amount']){
        $query = "INSERT INTO products (title, price, amount, user) VALUES ('{$_GET['title']}', {$_GET['price']}, {$_GET['amount']}, 1)";
        $result = mysqli_query($conn, $query);
    } else{
        $result = 0;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>1</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="main-content">
        <div class='messages-container'>
            <?php
                if ($result == 1){
                    echo "<p>Запись добавлена</p>";
                    echo "<a href='/table2.php' class='back_btn'>К таблице</a>";
                }else{
                    echo "<p>Что то пошло не так.</p>";
                    echo "<a href='/add_product1.php' class='back_btn'>Назад</a>";
                }
            ?>
            
        </div>
	</div>
</body>
</html>