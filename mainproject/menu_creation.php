
<?php
    include("database_conn.php");

    $querry = "SELECT * from category";
    $result_query_category = mysqli_query($link,$querry);
    while( $category = mysqli_fetch_array($result_query_category))
    {
        $cat_output = mb_strtoupper($category['name'], "UTF-8");
        echo "<h1>{$cat_output}</h1><hr>";
        $querry = "SELECT * FROM items WHERE category = {$category['category_id']}";
        $result_query_items = mysqli_query($link,$querry);
        echo "<div class='menu-content'>";
        while ($item = mysqli_fetch_array($result_query_items)){
            echo "<div class='item-card'>
                <img src='images/burger1.png' alt='Burger1' class='image-card'>
                <div class='info-container'>
                    <div class='title'>
                        {$item['title']}
                    </div>
                    <div class='description'>
                        {$item['description']}
                    </div>
                    <div class='price'>
                        {$item['price']} P
                    </div>
                    <button class='add-product'>
                        Добавить
                    </button>
                </div>
                </div>";
            
        }
        echo "</div>";
        echo "<div class='sepparator'></div>";
    }
?>