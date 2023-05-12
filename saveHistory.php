<?php
    require_once("db.php");
    require_once("json_exempel.php");

    $date = date('Y-m-d H-i-s');

    $stmt = $conn->prepare("INSERT INTO history(PersonID1, PersonID2, CardID, CardAmount, DebtID, Payment, CheckID, HouseID, HouseName, ActiveTime) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiiiss", $personID1, $personID2, $cardID, $saveCardAmount, $debtID, $savePayment, $checkID, $houseID, $houseName, $date);
    $stmt->execute();

?>