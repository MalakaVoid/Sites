<?php

    include('../../database_conn.php');

    $response = [
        "status_code" => 400,
        "message" => "Bad Request",
        "data" => null,
        "date" => date("Y-m-d H:i:s")
    ];

    function get_products($link, $response){
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

    function get_product_by_title($link, $title){
        $query = "SELECT item_id, title, description, is_visible, price, sale, img, c.name as category FROM items as i INNER JOIN category as c ON i.category = c.category_id WHERE title = '{$title}'";
        $result = mysqli_query($link, $query);
        $product = mysqli_fetch_array($result);
        return $product;
    }

    function check_category_existence($link ,$category){
        $query = "SELECT category_id, name FROM category WHERE name = '{$category}'";
        $result = mysqli_query($link, $query);
        return (mysqli_num_rows($result) > 0);
    }

    function get_category_by_name($link ,$category){
        $query = "SELECT category_id, name FROM category WHERE name = '{$category}'";
        $result = mysqli_query($link, $query);
        $category_result = mysqli_fetch_array($result);
        return $category_result;
    }

    function create_category($link ,$category){
        if (!check_category_existence($link,$category)){
            $query = "INSERT INTO category(name) VALUES ('{$category}');";
            $result_query = mysqli_query($link, $query);
        }

        $category_result = get_category_by_name($link,$category);
        return $category_result;
    }

    function add_product($link, $response){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_name = $_POST['category'];
        $sale = 0;
        if (isset($_POST['sale'])){
            $sale = 1;
        }

        $is_visible = 1;
        if (isset($_POST['visible'])){
            $is_visible = 0;
        }
        $file = $_FILES["image"];

        $category = create_category($link, $category_name)['category_id'];

        $getMime = explode('.', $file['name']);
        $mime = strtolower(end($getMime));
        if ($mime == 'png') {
            $target_dir = "../../images/products/";
            $file = $_FILES["image"];

            $name_f = mt_rand(0, 10000) . $file['name'];
            copy($file['tmp_name'], $target_dir . $name_f);
            
            $img =  "/images/products/".$name_f;

            $query = "INSERT INTO items (title, description, price, category, sale, img, is_visible)
                    VALUES ('{$title}', '{$description}', {$price}, '{$category}', {$sale}, '{$img}', {$is_visible})";
            $result_query = mysqli_query($link, $query);
            if ($result_query){
                $response["status_code"] = 200;
                $response["message"] = "Товар успешно добавлен";
                $response["data"] = get_product_by_title($link, $title);
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

    function get_product_by_id($link, $product_id){
        $query = "SELECT item_id, title, description, is_visible, price, sale, img, c.name as category FROM items as i INNER JOIN category as c ON i.category = c.category_id WHERE item_id = {$product_id}";
        $result = mysqli_query($link, $query);
        $product = mysqli_fetch_array($result);
        return $product;
    }

    function delete_product($link, $response, $product_id){
        $response["data"] = get_product_by_id($link, $product_id);
        $query = "DELETE FROM items WHERE item_id={$product_id}";
        $result_delete_product = mysqli_query($link, $query);

        if ($result_delete_product){
            $response["status_code"] = 200;
            $response["message"] = "Товар успешно удален";
            
        }
        else{
            $response["status_code"] = 500;
            $response["message"] = "Произошла ошибка при удалении товара";
            $response["data"] = null;
        }

        return $response;
    }

    function edit_product($link, $response){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_name = $_POST['category'];
        $sale = 0;
        if (isset($_POST['sale'])){
            $sale = 1;
        }

        $is_visible = 1;
        if (isset($_POST['visible'])){
            $is_visible = 0;
        }

        $category = create_category($link, $category_name)['category_id'];

        if (isset($_POST['image'])){
            $query = "UPDATE items SET is_visible = {$is_visible}, title='{$title}', description = '{$description}', price={$price}, category={$category}, sale={$sale} WHERE item_id={$id}";
            $result_query = mysqli_query($link, $query);
            if ($result_query){
                $response["status_code"] = 200;
                $response["message"] = "Товар успешно изменен";
                $response["data"] = get_product_by_title($link, $title);
            }
            else{
                $response["status_code"] = 500;
                $response["message"] = "Произошла ошибка при изменении товара";
                $response["data"] = null;
            }

            return $response;
        }

        $file = $_FILES["image"];
        $getMime = explode('.', $file['name']);
        $mime = strtolower(end($getMime));
        if ($mime == 'png') {
            $target_dir = "../../images/products/";
            $file = $_FILES["image"];

            $name_f = mt_rand(0, 10000) . $file['name'];
            copy($file['tmp_name'], $target_dir . $name_f);
            
            $img =  "/images/products/".$name_f;

            $query = "UPDATE items SET is_visible = {$is_visible}, title='{$title}', description = '{$description}', price={$price}, category={$category}, sale={$sale}, img='{$img}' WHERE item_id={$id}";
            $result_query = mysqli_query($link, $query);
            if ($result_query){
                $response["status_code"] = 200;
                $response["message"] = "Товар успешно изменен";
                $response["data"] = get_product_by_title($link, $title);
            }
            else{
                $response["status_code"] = 500;
                $response["message"] = "Произошла ошибка при изменении товара";
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

    if ($_POST['type'] == 'GET_PRODUCTS'){
        $response = get_products($link, $response);
    }

    if ($_POST['type'] == 'ADD_PRODUCT'){
        $response = add_product($link, $response);
    }

    if ($_POST['type'] == 'DELETE_PRODUCT'){
        $response = delete_product($link, $response, $_POST['data']);
    }

    if ($_POST['type'] == 'EDIT_PRODUCT'){
        $response = edit_product($link, $response);
    }

    echo json_encode($response);

?>