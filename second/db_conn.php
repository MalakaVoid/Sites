<?php
    $link = mysqli_connect("localhost", "root", "root");
    mysqli_select_db($link, "city");
    mysqli_set_charset($link,"utf8");
?>