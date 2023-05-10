<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["CheckID"])||empty($_GET["PersonID"])){
        errorWrite($version, "Must have CheckID and PersonID");
    }
    $checkID = $_GET["CheckID"];
    $personID = $_GET["PersonID"];
 
    $stmt = $conn->prepare("SELECT * FROM checks WHERE CheckID = ?");
    $stmt->bind_param("i", $checkID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        require_once("../saveHistory.php");
        
        $data = "Used check";
        jsonWrite($version, $data);
    }
    else(
        errorWrite($version, "Check not found")
    )


?>