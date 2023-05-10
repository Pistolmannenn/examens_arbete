<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["HouseID"])||empty($_GET["PersonID"])){
        errorWrite($version, "Must have HouseID and PersonID");
    }
    $houseID = $_GET["HouseID"];
    $personID = $_GET["PersonID"];
 
    $stmt = $conn->prepare("SELECT * FROM house WHERE HouseID = ?");
    $stmt->bind_param("i", $houseID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        require_once("../saveHistory.php");
        
        $data = "Bought house";
        jsonWrite($version, $data);
    }
    else(
        errorWrite($version, "House not found")
    )


?>