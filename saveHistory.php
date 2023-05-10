<?php
    require_once("db.php");
    require_once("json_exempel.php");

    $date = date('Y-m-d H-i-s');

    $stmt = $conn->prepare("INSERT INTO history(PersonID, CardID, CardAmount, DebtID, Payment, CheckID, HouseID, ActiveTime) VALUE (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisisiis", $personID, $cardID, $saveCardAmount, $debtID, $savePayment, $checkID, $houseID, $date);
    $stmt->execute();

?>