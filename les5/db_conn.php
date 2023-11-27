<?php
    $conn = mysqli_connect("localhost", "root", "root");
    mysqli_select_db($conn,"db1");
    mysqli_set_charset($conn,"utf8");
?>