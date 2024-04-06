<?php

    include('../../database_conn.php');

    $response = [
        "status_code" => 400,
        "message" => "Bad Request",
        "data" => null,
        "date" => date("Y-m-d H:i:s")
    ];

    function get_orders($link, $response){
        $query = "SELECT order_id, u.login as user, order_creation_date, order_arrival_date, price, addres
        FROM orders as o INNER JOIN users as u ON o.user_id = u.user_id";
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

    function get_order_by_id($link, $order_id){
        $query = "SELECT order_id, u.login as user, order_creation_date, order_arrival_date, price, addres
        FROM orders as o INNER JOIN users as u ON o.user_id = u.user_id WHERE order_id = {$order_id}";
        $result = mysqli_query($link, $query);
        $product = mysqli_fetch_array($result);
        return $product;
    }

    function delete_order($link, $response, $order_id){
        $response["data"] = get_order_by_id($link, $order_id);

        $query = "DELETE FROM orders WHERE order_id = {$order_id}";
        $result_delete_order = mysqli_query($link, $query);

        if ($result_delete_order){
            $response["status_code"] = 200;
            $response["message"] = "Заказ успешно удален";
            
        }
        else{
            $response["status_code"] = 500;
            $response["message"] = "Произошла ошибка при удалении заказа";
            $response["data"] = null;
        }

        return $response;
    }

    if ($_POST['type'] == 'GET_ORDERS'){
        $response = get_orders($link, $response);
    }

    if ($_POST['type'] == 'DELETE_ORDER'){
        $response = delete_order($link, $response, $_POST['data']);
    }

    echo json_encode($response);

?>