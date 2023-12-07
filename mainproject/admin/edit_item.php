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
    if (isset($_POST["item_id"])){
        $item_id = $_POST["item_id"];

        $query = "SELECT * from items WHERE item_id={$item_id}";
        $result = mysqli_query($link, $query);
        $item = mysqli_fetch_array($result);

        $title_item = $item['title'];
        $description = $item['description'];
        $price = $item['price'];
        $category = $item['category'];
        $sale = $item['sale'];
    }
    else{
        header("Location: /admin/products.php");   
    }

    if (isset($_POST['title'])){
        $title_item = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $sale = 0;
        if (isset($_POST['sale'])){
            $sale = 1;
        }
        
        $query = "UPDATE items SET title='{$title_item}', description = '{$description}', price={$price}, category={$category}, sale={$sale} WHERE item_id={$item_id}";
        $result = mysqli_query($link, $query);
        if ($result){
            $errors = 'Запись успешно изменена.';
        }
        else{
            $errors = 'Что-то пошло не так.';
        }
    }
    $checked = "";
    if ($sale == 1){
        $checked="checked";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Edit user</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/admins.css'>
</head>
<body>
    <?php
        include("header.php");
    ?>   
    <main id='edit-user-page'>
        <form action='/admin/edit_item.php' method='POST'>
            <div class='container-form'>
                <h1>Изменить пользователя</h1>
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
                    <select name='category' required>
                    <option></option>";
                    while ($cat = mysqli_fetch_array($result_query)){
                        if ($cat['category_id']==$category){
                            echo "<option value='{$cat['category_id']}' selected>{$cat['name']}</option>";
                        }
                        else{
                            echo "<option value='{$cat['category_id']}'>{$cat['name']}</option>";
                        }
                    }
                    echo" </select>
                    <div>
                        <input type='checkbox' name='sale' {$checked}> Акция
                    </div>
                    <input type='hidden' name='item_id' value='{$item_id}'>
                    <button type='submit'>Изменить</button>";
                ?>
            </div>
        </form>
    </main>
</body>
</html>