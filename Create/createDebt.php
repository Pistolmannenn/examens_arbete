<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["DebtAmount"])){
       errorWrite($version, "Must have DebtAmount");
    }

    $stmt = $conn->prepare("INSERT INTO debt(DebtAmount) VALUES (?)");
    $stmt->bind_param("i", $_GET["DebtAmount"]);
    $stmt->execute();

    $data = "Created debt";
    jsonWrite($version, $data);


?>