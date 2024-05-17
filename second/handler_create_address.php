<?php
    include("db_conn.php");

    $distinct_id = $_POST["district"];
    $region_id = $_POST["region"];
    $street_id = $_POST["street"];

    $sql = "SELECT d.name, r.name, s.name FROM disctrict as d, region as r, street as s WHERE d.district_id = {$distinct_id} AND r.region_id = {$region_id} AND s.street_id = {$street_id}";
    $result_querry = mysqli_query($link, $sql);
    $result_array = mysqli_fetch_array($result_querry);

    echo "Округ {$result_array[0]}, Район {$result_array[1]}, Улица {$result_array[2]}";

?>