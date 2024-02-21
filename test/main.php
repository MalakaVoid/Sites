<?php
function get_users(){
        include("db_conn.php");
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);
        if ($result != null){
            return $result;
        } else{
            return 404;
        }
    }

    $users = get_users();
    // while ($user = mysqli_fetch_array($users)){
    //     echo $user['password'];
    // }
?>

<?php while ($user = mysqli_fetch_array($users)): ?>

<h1> <?php echo $user['last_name']; ?></h1>
<?php endwhile;?>