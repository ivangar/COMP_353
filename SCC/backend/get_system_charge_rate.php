
<?php

if (!isset($_SESSION)) {session_start();}
$user_id = $_SESSION['active_user']['user_id'];

// TODO: check if is controller

$sql = "SELECT charge_rate FROM system_charge_rate WHERE system_charge_rate_id = 1";
$result = $conn->query($sql);
$charge_rate = "Not Set";

if ($result->num_rows > 0) {
    $charge_rate = ($result->fetch_assoc()['charge_rate']);
}
