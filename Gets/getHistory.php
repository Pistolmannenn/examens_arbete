<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    $stmt = $conn->prepare("SELECT * FROM history ORDER BY Scantime DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $history[] = $row;
        }
        $data = ["Result"=>$history];
        jsonWrite($version, $data);
    }


?>