<?php
    include("database_connection.php");
    var_dump($_POST["options"]);
    if (!isset($_POST['options']) or $_POST['options'] == null){
        $query = "SELECT * FROM workout_cards;";
    }
    else{
        $a =1;
    }

    $result = mysqli_query($conn, $query);



function create_elements($result){
    while ($card = mysqli_fetch_array($result)): ?>
<a class="mini-card">
    <img src="../assets/images/workout_cards/<?php echo $card['img_src'];?>">
    <div class="raiting">
        <span class="t"><?php echo $card['rating'];?>%
            <img src="../assets/images/workout_cards/thumbsup.webp">
        </span>
        <span class="b"><?php echo $card['votes'];?> votes</span>
    </div>
    <h3 class="title"><?php echo $card['title'];?></h3>
    <div class="attention-container">
        <span class="attention red"><?php echo $card['difficulty']?></span>
    </div>
    <div class="type"><?php echo $card['type'];?></div>
    <div class="duration">
        <span class="dur"><?php echo $card['duration'];?></span>
        <span class="dur-type"><?php echo $card['duration_type'];?></span>
    </div>
    <div class="desc"><?php echo $card['description'];?></div>
    <div class="stats-container">
        <div class="stats">Started by <span><?php echo $card['stats'];?></span> users this month</div>
        <div class="btn-container"><div class="btn">VIEW</div></div>
    </div>
</a>

<?php endwhile;
}
?>