<?php
    require_once("../db.php");
    require_once("../json_exempel.php");

    if(empty($_GET["DebtID"])||empty($_GET["Payment"])||empty($_GET["PersonID"])){
        errorWrite($version, "Must have DebtID, Payment and PersonID");
    }
    $debtID = $_GET["DebtID"];
    $payment = $_GET["Payment"];
    $personID1 = $_GET["PersonID"];

    $stmt = $conn->prepare("SELECT DebtAmount FROM debt WHERE DebtID = ? ");
    $stmt->bind_param("i", $debtID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        $savePayment = $payment;
        require("../saveHistory.php");
        $savePayment = null;

        $newDebtAmount = $row["DebtAmount"] - $payment;

        if ($newDebtAmount <= 0){
            $stmt = $conn->prepare("DELETE FROM debt WHERE DebtID = ? ");
            $stmt->bind_param("i", $debtID);
            $stmt->execute();
            
            require("../saveHistory.php");

            $data = "Debt paid";
        }
        else{
            $stmt = $conn->prepare("UPDATE debt SET DebtAmount = ? WHERE DebtID = ? ");
            $stmt->bind_param("ii", $newDebtAmount, $debtID);
            $stmt->execute();

            $data = "Uppdated debt";
        }

        jsonWrite($version, $data);
    }
    else(
        errorWrite($version, "Check not found")
    )
 

?>