<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["HouseID"])||empty($_GET["BuyerID"])||empty($_GET["SellerID"])){
        errorWrite($version, "Must have HouseID, BuyerID and SellerID");
    }
    $houseID = $_GET["HouseID"];
    $personID1 = $_GET["BuyerID"];
    $personID2 = $_GET["SellerID"];
 
    $stmt = $conn->prepare("SELECT * FROM house WHERE HouseID = ?");
    $stmt->bind_param("i", $houseID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $houseName =  $row["HouseName"];

        require_once("../saveHistory.php");
        
        $data = "Bought house";
        jsonWrite($version, $data);
    }
    else(
        errorWrite($version, "House not found")
    )


?>