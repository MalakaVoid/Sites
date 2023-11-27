<?php
    include("db_conn.php");
?>
<?php
    $ids = $_GET['del_ids'];
    $message_err = '';
    foreach($ids as $id) {
        $query = "DELETE FROM products WHERE product_id = {$id}";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $message_err .= "Запись {$id} успешно удалена.<br>";
        } else {
            $message_err .= "Что то пошло не так с записью {$id}";
        }
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
                echo $message_err;
            ?>
            </p>
            <a href='/table2.php' class='back_btn'>К таблице</a>
        </div>
	</div>
</body>
</html>