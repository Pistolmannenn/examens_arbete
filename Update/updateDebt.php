<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["DebtID"])||empty($_GET["Payment"])){
        errorWrite($version, "Must have DebtID and Payment");
    }

    $stmt = $conn->prepare("SELECT DebtAmount FROM debt WHERE DebtID = ? ");
    $stmt->bind_param("i", $_GET["DebtID"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        print_r($row["DebtAmount"]);
        die();

        $stmt = $conn->prepare("UPDATE debt SET DebtAmount = ? WHERE DebtID = ? ");
        $stmt->bind_param("ii", $_GET["DebtAmount"], $_GET["DebtID"]);
        $stmt->execute();

        $data = "Uppdated debt";
        jsonWrite($version, $data);
    }
 

    


?>