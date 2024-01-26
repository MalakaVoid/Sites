<?php
    include("database_connection.php");

    if (!isset($_POST['a']) or $_POST['a'] == null){
        $query = "SELECT * FROM workout_cards;";
    } 
    elseif (isset($_POST['a']) and $_POST['a'] == 1){
        $query = "SELECT * FROM workout_cards LIMIT 1;";
    }
    elseif (isset($_POST['a']) and $_POST['a'] == 2){
        $query = "SELECT * FROM workout_cards LIMIT 2;";
    }
    else{
        echo "NOTHING FOUND";
    }

    $result = mysqli_query($conn, $query);
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

<?php endwhile;?>