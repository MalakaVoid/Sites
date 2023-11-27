<?php
    include("db_conn.php");
?>
<?php
    $query = "UPDATE products SET title='{$_GET['title']}', price = {$_GET['price']}, amount = {$_GET['amount']} WHERE product_id = {$_GET['id']}";
    $result = mysqli_query($conn, $query);
    if ($result){
        $text_err = "Запись обновлена";
    }
    else{
        $text_err = "Что то пошло не так.";
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
            <p>
            <?php
                echo $text_err;
            ?>
            </p>
            <a href='/table2.php' class='back_btn'>К таблице</a>
        </div>
	</div>
</body>
</html>