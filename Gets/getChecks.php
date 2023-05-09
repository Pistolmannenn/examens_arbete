<?php
    require_once("../db.php");

    $stmt = $conn->prepare("SELECT * FROM checks");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $checks[] = $row;
        }
        $data = ["Result"=>$checks];
        jsonWrite($version, $data);
    }


?>