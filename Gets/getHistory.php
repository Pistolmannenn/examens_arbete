<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    $stmt = $conn->prepare("SELECT * FROM history ORDER BY ActiveTime DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if(!empty($row["CardID"])){
                if(!empty($row["CardAmount"])){
                    $row = ["Datatype" => "Card add", "PersonID" => $row["PersonID"], "CardID"=> $row["CardID"], "CardAmount"=> $row["CardAmount"], "ActiveTime"=> $row["ActiveTime"]];
                }
                else{
                    $row = ["Datatype" => "Card done", "PersonID" => $row["PersonID"], "CardID"=> $row["CardID"], "ActiveTime"=> $row["ActiveTime"]];
                }
            }
            $history[] = $row;
        }
        $data = ["Result"=>$history];
        jsonWrite($version, $data);
    }


?>