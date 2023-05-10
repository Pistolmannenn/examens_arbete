<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["CardID"])||empty($_GET["CardAmount"])){
        errorWrite($version, "Must have CardID and CardAmount");
    }
 
    $stmt = $conn->prepare("SELECT CardAmount FROM card WHERE CardID = ?");
    $stmt->bind_param("i", $_GET["CardID"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        $newCardAmount = $row["CardAmount"] + $_GET["CardAmount"];

        if ($newCardAmount >= 10){
            $stmt = $conn->prepare("UPDATE card SET CardAmount = 0 WHERE CardID = ?");
            $stmt->bind_param("i", $_GET["CardID"]);
            $stmt->execute();

            $data = "Card done";
            jsonWrite($version, $data);
        }


        $stmt = $conn->prepare("UPDATE card SET CardAmount = ? WHERE CardID = ?");
        $stmt->bind_param("ii", $newCardAmount, $_GET["CardID"]);
        $stmt->execute();

        $data = "Uppdated card";
        jsonWrite($version, $data);
    }


?>