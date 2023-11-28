<?php
    session_start();
    if (isset($_SESSION["user_id"])){
        #none
    } else{
        header("authorization.php");
        exit;
    }
?>