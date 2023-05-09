<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["CardID"])||empty($_GET["CardAmount"])){
        errorWrite($version, "Must have CardID and CardAmount");
     }
 

    $stmt = $conn->prepare("UPDATE card SET CardAmount = ? WHERE CardID = ? ");
    $stmt->bind_param("ii", $_GET["CardAmount"], $_GET["CardID"]);
    $stmt->execute();

    $data = "Uppdated date";
    jsonWrite($version, $data);


?>