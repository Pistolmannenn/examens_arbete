<?php
    require_once("db.php");
    require_once("json_exempel.php");

    $stmt = $conn->prepare("UP(CardAmount) VALUES (?) ");
    $stmt->bind_param("i", 10);
    $stmt->execute();
    $cardID = $stmt->insert_id();

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            print_r($row);
        }
    }


?>