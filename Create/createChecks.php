<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["CheckName"])||empty($_GET["Discount"])){
       errorWrite($version, "Must have CheckName and Discount");
    }

    $stmt = $conn->prepare("INSERT INTO checks(CheckName, Discount) VALUES (?, ?)");
    $stmt->bind_param("si", $_GET["CheckName"], $_GET["Discount"]);
    $stmt->execute();

    $data = "Created check";
    jsonWrite($version, $data);


?>