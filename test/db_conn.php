<?php
    $_server_name = "localhost";
    $_username = "root";
    $_password = "root";
    $_database = "db2";
    
    $conn = mysqli_connect($_server_name, $_username, $_password, $_database);
    if ($conn->connect_error){
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    mysqli_set_charset($conn,"utf8");
?>