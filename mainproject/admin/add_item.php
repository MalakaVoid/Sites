<?php
    session_start();
    if (isset($_SESSION["user"])){
        if ($_SESSION["user"]['is_admin']==0){
            header('Location: /');
            exit;
        }
    }
    else{
        header('Location: ../authorization.php');
        exit;
    }
    include('../database_conn.php');
    $errors = "";
    $title_item = "";
    $description = "";
    $price = "";
    $category = "";
    $sale = "";
    $img = "";
    $is_visible = "";
    if (isset($_POST['title'])){
        $title_item = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $is_visible = $_POST['is_visible'];
        $sale = 0;
        if (isset($_POST['sale'])){
            $sale = 1;
        }

        if(isset($_FILES['img']) && $_FILES['img']['name']!= '') {
            $file = $_FILES["img"];
            $getMime = explode('.', $file['name']);
            $mime = strtolower(end($getMime));
            if ($mime == 'png') {
                $target_dir = "../images/products/";
                $file = $_FILES["img"];

                $name_f = mt_rand(0, 10000) . $file['name'];
                copy($file['tmp_name'], "../images/products/" . $name_f);
                
                $img =  "/images/products/".$name_f;

                $query = "INSERT INTO items (title, description, price, category, sale, img, is_visible)
                        VALUES ('{$title_item}', '{$description}', {$price}, {$category}, {$sale}, '{$img}', {$is_visible})";
                // echo $query;
                $result_query = mysqli_query($link, $query);
                // echo $result_query;
                if ($result_query){
                    $errors = "Новый товар успешно добавлен";
                    $title_item = "";
                    $description = "";
                    $price = "";
                    $category = "";
                    $sale = "";
                    $img = "";
                    $is_visible = "";
                }
                else{
                    $errors = "Что-то пошло не так! Попробуйте еще раз.";
                }
            }
            else{
                $errors = "Выберите картинку с расширением PNG!";
            }
        } else{
            $errors = "Добавьте картинку!";
        }
        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Add Product</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/admins.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>   
    <main id='items-add-page'>
        <form action='/admin/add_item.php' method='POST' enctype="multipart/form-data">
            <div class='container-form'>
                <h1>Добавить товар</h1>
                <?php
                    if ($errors != ""){
                        echo "<div class='errors'>
                        {$errors}
                            </div>";
                    }
                    $query = "SELECT * FROM category";
                    $result_query = mysqli_query($link, $query);
                    echo "<input type='text' name='title' placeholder='Название' required value='{$title_item}'>
                    <textarea placeholder='Описание' rows='10' cols='45' name='description'>{$description}</textarea>
                    <input type='number' name='price' placeholder='Цена' required value='{$price}'>
                    <input type='number' name='is_visible' placeholder='Видимость' required value='{$is_visible}'>
                    <select name='category' required>
                    <option></option>";
                    while ($cat = mysqli_fetch_array($result_query)){
                        echo "<option value='{$cat['category_id']}'>{$cat['name']}</option>";
                    }
                    echo" </select>

                    <div>
                        <label for='img' class='img-label'>Выберите картинку</label>
                        <input type='file' id='img' class='img-file' name='img'>
                    </div>
                    <div class='preview'>
                        
                    </div>


                    <div>
                        <label>
                            <input type='checkbox' name='sale'> <span></span>
                            Акция
                        </label>
                    </div>
                    <button type='submit'>Добавить</button>";
                ?>
            </div>
        </form>
        <script src="test.js"></script>
    </main>
</body>
</html>