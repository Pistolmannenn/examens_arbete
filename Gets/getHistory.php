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
                    $row = ["Datatype" => "Card add", "OwnerID" => $row["PersonID"], "CardID"=> $row["CardID"], "CardAmount"=> $row["CardAmount"], "ActiveTime"=> $row["ActiveTime"]];
                }
                else{
                    $row = ["Datatype" => "Card done", "OwnerID" => $row["PersonID"], "CardID"=> $row["CardID"], "ActiveTime"=> $row["ActiveTime"]];
                }
            }
            elseif(!empty($row["DebtID"])){
                if(!empty($row["Payment"])){
                    $row = ["Datatype" => "Payment", "PayerID" => $row["PersonID"], "DebtID"=> $row["DebtID"], "Payment"=> $row["Payment"], "PaymentTime"=> $row["ActiveTime"]];
                }
                else{
                    $row = ["Datatype" => "Debt paid", "PayerID" => $row["PersonID"], "DebtID"=> $row["DebtID"], "PaymentTime"=> $row["ActiveTime"]];
                }
            }
            elseif(!empty($row["CheckID"])){
                $row = ["Datatype" => "Check used", "OwnerID" => $row["PersonID"], "CheckID"=> $row["CheckID"], "UseTime"=> $row["ActiveTime"]];
            }
            elseif(!empty($row["HouseID"])){
                $row = ["Datatype" => "House sold", "BuyerID" => $row["PersonID"], "HouseID"=> $row["HouseID"], "SellingTime"=> $row["ActiveTime"]];
            }
            $history[] = $row;
        }
        $data = ["Result"=>$history];
        jsonWrite($version, $data);
    }


?>