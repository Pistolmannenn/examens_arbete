<?php
    require_once("db.php");
    require_once("json_exempel.php");

    $date = date('Y-m-d H-i-s');

    $stmt = $conn->prepare("INSERT INTO history(PersonID, CardID, CardAmount, DebtID, DebtAmount, CheckID, HouseID, ScanTime) VALUE (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisisiis", $personID, $cardID, $cardAmount, $debtID, $payment, $checkID, $houseID, $date);
    $stmt->execute();

?>