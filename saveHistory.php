<?php
    require_once("db.php");
    require_once("json_exempel.php");

    $date = date('Y-m-d H-i-s');

    $stmt = $conn->prepare("INSERT INTO history(PersonID1, PersonID2, CardID, DebtID, CheckID, HouseID, HouseName, Amount, ActiveTime) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiisis", $personID1, $personID2, $cardID, $debtID, $checkID, $houseID, $houseName, $amount,  $date);
    $stmt->execute();

?>