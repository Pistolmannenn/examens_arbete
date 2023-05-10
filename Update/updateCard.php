<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["CardID"])||empty($_GET["CardAmount"])||empty($_GET["PersonID"])){
        errorWrite($version, "Must have CardID, CardAmount and PersonID");
    }
    $cardID = $_GET["CardID"];
    $cardAmount = $_GET["CardAmount"];
    $personID = $_GET["PersonID"];
 
    $stmt = $conn->prepare("SELECT CardAmount FROM card WHERE CardID = ?");
    $stmt->bind_param("i", $cardID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        $saveCardAmount = $cardAmount;
        require("../saveHistory.php");
        $saveCardAmount = null;

        $newCardAmount = $row["CardAmount"] + $cardAmount;

        if ($newCardAmount >= 10){
            $stmt = $conn->prepare("UPDATE card SET CardAmount = 0 WHERE CardID = ?");
            $stmt->bind_param("i", $cardID);
            $stmt->execute();

            require("../saveHistory.php");

            $data = "Card done";
        }
        else{
            $stmt = $conn->prepare("UPDATE card SET CardAmount = ? WHERE CardID = ?");
            $stmt->bind_param("ii", $newCardAmount, $cardID);
            $stmt->execute();

            $data = "Uppdated card";
        }

        jsonWrite($version, $data);
    }
    else(
        errorWrite($version, "Card not found")
    )

?>