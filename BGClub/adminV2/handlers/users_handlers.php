<?php

    include('../../database_conn.php');

    $response = [
        "status_code" => 400,
        "message" => "Bad Request",
        "data" => null,
        "date" => date("Y-m-d H:i:s")
    ];

    function getUsers($link, $response){
        $query = "SELECT * FROM users";
        $result = mysqli_query($link, $query);
    
        if ($result){
            $users_arr = [];
    
            while ($user_item = mysqli_fetch_array($result)) {
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

        return $response;
    }

    function get_user_by_login($link, $login){
        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = mysqli_query($link, $query);
        $user = mysqli_fetch_array($result);
        return $user;
    }

    function get_user_by_user_id($link, $user_id){
        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($link, $query);
        $user = mysqli_fetch_array($result);
        return $user;
    }

    function is_login_exist($link, $login){
        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = mysqli_query($link, $query);
        return (mysqli_num_rows($result) > 0);
    }

    function add_user($link, $response, $user_data){
        $login = $user_data['login'];
        $password = $user_data['password'];
        $first_name = $user_data['name'];
        $last_name = $user_data['surname'];
        $email = $user_data['email'];
        if ($user_data['admin']){
            $is_admin = 1;
        } else{
            $is_admin = 0;
        }

        if (is_login_exist($link, $login)){
            $response["status_code"] = 400;
            $response["message"] = "Login already exists";
            $response["data"] = null;

            return $response;
        }

        $query = "INSERT INTO users (`login`, `password`, `first_name`, `last_name`, `email`, is_admin) 
                VALUES ('{$login}', '{$password}', '{$first_name}', '{$last_name}', '{$email}', {$is_admin})";
        $result_query = mysqli_query($link, $query);

        if ($result_query){
            $response["status_code"] = 200;
            $response["message"] = "Пользователь {$login} успешно добавлен.";
            $response["data"] = get_user_by_login($link, $login);
        }
        else{
            $response["status_code"] = 500;
            $response["message"] = "Database error";
            $response["data"] = null;
        }

        return $response;
            
    }

    function delete_user($link, $response, $user_id){
        $response["data"] = get_user_by_user_id($link, $user_id);
        $query_delete_user = "DELETE FROM users WHERE user_id={$user_id}";
        $result_delete_user = mysqli_query($link, $query_delete_user);

        if ($result_delete_user){
            $response["status_code"] = 200;
            $response["message"] = "Пользователь успешно удален";
            
        }
        else{
            $response["status_code"] = 500;
            $response["message"] = "Произошла ошибка при удалении пользователя";
            $response["data"] = null;
        }

        return $response;
    }

    function edit_user($link, $response, $user_data){
        $user_id = $user_data['id'];
        $login = $user_data['login'];
        $password = $user_data['password'];
        $first_name = $user_data['name'];
        $last_name = $user_data['surname'];
        $email = $user_data['email'];
        if ($user_data['admin']){
            $is_admin = 1;
        } else{
            $is_admin = 0;
        }
        
        $response["data"]['prev_user'] = get_user_by_user_id($link, $user_id);
        
        $query = "UPDATE users SET login='{$login}', password = '{$password}', first_name='{$first_name}', last_name='{$last_name}', email='{$email}', is_admin={$is_admin} WHERE user_id={$user_id}";
        $result = mysqli_query($link, $query);

        if ($result){
            $response["data"]['new_user'] = get_user_by_user_id($link, $user_id);
            $response["status_code"] = 200;
            $response["message"] = "Запись успешно изменена.";
        } else{
            $response["status_code"] = 500;
            $response["message"] = "Database error";
            $response["data"] = null;
        }

        return $response;
        
    }


    if ($_POST['type'] == 'GET_USERS'){
        $response = getUsers($link, $response);
    }

    if ($_POST['type'] == 'ADD_USER'){
        $response = add_user($link, $response, $_POST['data']);
    }

    if ($_POST['type'] == 'DELETE_USER'){
        $response = delete_user($link, $response, $_POST['data']);
    }

    if ($_POST['type'] == 'EDIT_USER'){
        $response = edit_user($link, $response, $_POST['data']);
    }



    echo json_encode($response);

?>