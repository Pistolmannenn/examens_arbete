<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(isset($_GET["CardAmount"])){
        $stmt = $conn->prepare("INSERT INTO card(CardAmount) VALUES (?) ");
        $stmt->bind_param("i", $_GET["CardAmount"]);
        $stmt->execute();

        $data = "Created card with amount";
        jsonWrite($version, $data);
    
       
    }

    $stmt = $conn->prepare("INSERT INTO card() VALUE ()");
    $stmt->execute();

    $data = "Created card";
    jsonWrite($version, $data);


?>