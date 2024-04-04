<?php

    include('../../database_conn.php');

    $response = [
        "status_code" => 400,
        "message" => "Bad Request",
        "data" => null,
        "date" => date("Y-m-d H:i:s")
    ];

    function getUsers($link){
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
    }


    function add_user($link, $user_data){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $is_admin = 0;

        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0){
            $errors = "Данный логин уже занят";
        }
        else{
            $query = "INSERT INTO users (`login`, `password`, `first_name`, `last_name`, `email`, is_admin) 
                    VALUES ('{$login}', '{$password}', '{$first_name}', '{$last_name}', '{$email}', {$is_admin})";
            $result_query = mysqli_query($link, $query);
            if ($result_query){
                $errors = "Новый пользователь успешно добавлен";
                $login = "";
                $password = "";
                $first_name = "";
                $last_name = "";
                $email = "";
            }
            else{
                $errors = "Что-то пошло не так! Попробуйте еще раз.";
            }
        }
            
    }


    if ($_POST['type'] == 'GET_USERS'){
        getUsers($link);
    }

?>