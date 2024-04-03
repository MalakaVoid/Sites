<?php

    include('../../database_conn.php');

    $response = [
        "status_code" => 400,
        "message" => "Bad Request",
        "data" => null,
        "date" => date("Y-m-d H:i:s")
    ];

    $query = "SELECT * FROM users";
    $result = mysqli_query($link, $query);

    if ($result){
        $users_arr = [];

        while ($user_item = mysqli_fetch_array($result)) {
            // $user = [
            //     "user_id" => $user_item['user_id'],
            //     "login" => $user_item['login'],
            //     "password" => $user_item['password'],
            //     "first_name" => $user_item['first_name'],
            //     "last_name" => $user_item['last_name'],
            //     "email" => $user_item['email'],
            //     "is_admin" => $user_item['is_admin']
            // ];
            array_push($users_arr, $user_item);
        }

        $response["status_code"] = 200;
        $response["message"] = "OK";
        $response["data"] = $users_arr;
    } else{
        $response["status_code"] = 500;
        $response["message"] = "Internal Server Error";
        $response["data"] = null;
    }


    echo json_encode($response);

?>