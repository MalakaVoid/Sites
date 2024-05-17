<?php
    include("db_conn.php");

    if (!isset($_POST["type"])){
        return;
    }

    function getDistrict($link) {
        $sql = "SELECT district_id, name FROM disctrict";
        $result_querry = mysqli_query($link, $sql);
        $result = [];
        while ($item = mysqli_fetch_array($result_querry)) {
            $result[$item["district_id"]] = $item["name"];
        }
        return json_encode($result);
    }

    function getRegion($link, $district_id) {
        $sql = "SELECT region_id, name FROM region WHERE district_id = {$district_id}";
        $result_querry = mysqli_query($link, $sql);
        $result = [];
        while ($item = mysqli_fetch_array($result_querry)) {
            $result[$item["region_id"]] = $item["name"];
        }
        return json_encode($result);
    }


    function getStreet($link, $region_id) {
        $sql = "SELECT street_id, name FROM street WHERE region_id = {$region_id}";
        $result_querry = mysqli_query($link, $sql);
        $result = [];
        while ($item = mysqli_fetch_array($result_querry)) {
            $result[$item["street_id"]] = $item["name"];
        }
        return json_encode($result);
    }


    if ($_REQUEST["type"] == "district") {
        echo getDistrict($link);
    }

    if ($_POST["type"] == "region") {
        echo getRegion($link, $_POST["region_id"]);
    }

    if ($_POST["type"] == "street") {
        echo getStreet($link, $_POST["street_id"]);
    }

?>