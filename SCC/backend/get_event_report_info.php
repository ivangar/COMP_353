<?php
/*
Author: Jesse Desmarais
ID: 40035761
This script retrievs information for the event report
*/

include "connection.php";
// session_start();
if (!isset($_SESSION['active_user'])) {
    header("Location: ../frontend/dashboard.php");
}
include "connection.php";
$event_id = $_GET["event_id"];
$user_id = $_SESSION['active_user']['user_id'];

$sql = "SELECT * FROM events WHERE event_manager_id = $user_id AND event_id = $event_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    //header("Location: ../frontend/dashboard.php");
    echo "user : " . $user_id . " event : " . $event_id;
}

$event = $result->fetch_assoc();
$event_id = $event["event_id"];
$event_name = $event["event_name"];
$event_cost = $event["total_cost"];
$event_start = $event["start_date"];
$event_end = $event["end_date"];
$event_primary_group_id = $event["primary_event_group_id"];
