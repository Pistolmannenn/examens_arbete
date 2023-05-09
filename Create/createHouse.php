<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["HouseName"])||empty($_GET["HousePrice"])){
       errorWrite($version, "Must have HouseName and HousePrice");
    }

    $stmt = $conn->prepare("INSERT INTO house(HouseName, HousePrice) VALUES (?, ?)");
    $stmt->bind_param("si", $_GET["HouseName"], $_GET["HousePrice"]);
    $stmt->execute();

    $data = "Created house";
    jsonWrite($version, $data);


?>