<?php

    include('../../database_conn.php');

    $response = [
        "status_code" => 400,
        "message" => "Bad Request",
        "data" => null,
        "date" => date("Y-m-d H:i:s")
    ];

    function getProducts($link, $response){
        $query = "SELECT item_id, title, description, is_visible, price, sale, img, c.name as category FROM items as i INNER JOIN category as c ON i.category = c.category_id";
        $result = mysqli_query($link, $query);
    
        if ($result){
            $products_arr = [];
    
            while ($user_item = mysqli_fetch_array($result)) {
                array_push($products_arr, $user_item);
            }
    
            $response["status_code"] = 200;
            $response["message"] = "OK";
            $response["data"] = $products_arr;
        } else{
            $response["status_code"] = 500;
            $response["message"] = "Internal Server Error";
            $response["data"] = null;
        }

        return $response;
    }

    function getProductByTitle($link, $title){
        $query = "SELECT item_id, title, description, is_visible, price, sale, img, c.name as category FROM items as i INNER JOIN category as c ON i.category = c.category_id WHERE title = '{$title}'";
        $result = mysqli_query($link, $query);
        $product = mysqli_fetch_array($result);
        return $product;
    }

    function add_product($link, $response){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $sale = 0;
        $is_visible = 0;
        $file = $_FILES["image"];

        $getMime = explode('.', $file['name']);
        $mime = strtolower(end($getMime));
        if ($mime == 'png') {
            $target_dir = "../../images/products/";
            $file = $_FILES["image"];

            $name_f = mt_rand(0, 10000) . $file['name'];
            copy($file['tmp_name'], $target_dir . $name_f);
            
            $img =  "/images/products/".$name_f;

            $query = "INSERT INTO items (title, description, price, category, sale, img, is_visible)
                    VALUES ('{$title}', '{$description}', {$price}, {$category}, {$sale}, '{$img}', {$is_visible})";
            $result_query = mysqli_query($link, $query);
            if ($result_query){
                $response["status_code"] = 200;
                $response["message"] = "Товар успешно добавлен";
                $response["data"] = getProductByTitle($link, $title);
            }
            else{
                $response["status_code"] = 500;
                $response["message"] = "Произошла ошибка при добавлении товара";
                $response["data"] = null;
            }
        }
        else{
            $response["status_code"] = 400;
            $response["message"] = "Необходимо изображение в формате PNG";
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
        
        $query = "UPDATE users SET login='{$login}', password = '{$password}', first_name='{$first_name}', last_name='{$last_name}', email='{$email}', is_admin={$is_admin} WHERE user_id={$user_id}";
        $result = mysqli_query($link, $query);

        if ($result){
            $response["status_code"] = 200;
            $response["message"] = "Запись успешно изменена.";
            $response["data"] = get_user_by_user_id($link, $user_id);
        } else{
            $response["status_code"] = 500;
            $response["message"] = "Database error";
            $response["data"] = null;
        }

        return $response;
        
    }

    if ($_POST['type'] == 'GET_PRODUCTS'){
        $response = getProducts($link, $response);
    }

    if ($_POST['type'] == 'ADD_PRODUCT'){
        $response = add_product($link, $response);
    }
    
    if ($_POST['type'] == 'DELETE_USER'){
        $response = delete_user($link, $response, $_POST['data']);
    }

    if ($_POST['type'] == 'EDIT_USER'){
        $response = edit_user($link, $response, $_POST['data']);
    }

    echo json_encode($response);

?>