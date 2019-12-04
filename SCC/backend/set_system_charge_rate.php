<?php
include "connection.php";

if (!isset($_SESSION)) {session_start();}

$charge_rate = $_POST['charge_rate'];

// TODO: check if is controller

$sql = "SELECT * FROM system_charge_rate WHERE system_charge_rate_id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql = "UPDATE system_charge_rate set charge_rate = $charge_rate where system_charge_rate_id = 1";
} else {
    $sql = "INSERT INTO system_charge_rate(charge_rate) VALUES($charge_rate)";
}

if ($conn->query($sql) != true) {
    header("Location: ../frontend/event_controller_page.php?charge_rate_update=fail");
} else {
    header("Location: ../frontend/event_controller_page.php?charge_rate_update=success");
}
$conn->close();
