
<?php
    include('../../database_conn.php');

    $response = [
        "status_code" => 400,
        "message" => "Bad Request",
        "data" => null,
        "date" => date("Y-m-d H:i:s")
    ];


    if (isset($_POST['user_id'])){

        $query_get_users = "SELECT * FROM users WHERE id = '{$_POST['user_id']}'";
        $result_get_users = mysqli_query($link, $query);
        $deleted_user = mysqli_fetch_array($result_get_users);

        $query_delete_user = "DELETE FROM users WHERE user_id={$_POST['user_id']}";
        $result_delete_user = mysqli_query($link, $query);

        if ($result){
            $response["status_code"] = 200;
            $response["message"] = "Пользователь успешно удален";
            $response["data"] = $deleted_user;
        }
        else{
            $response["status_code"] = 500;
            $response["message"] = "Произошла ошибка при удалении пользователя";
            $response["data"] = $deleted_user;
        }
    }

    echo json_encode($response);

?>
