<?php

session_start();
$user_id = $_SESSION['active_user']['user_id'];
$group_id = $_GET["group_id"];

// TODO: get if user_id exists in the group. else no

$sql = "SELECT * FROM instant_messages m LEFT JOIN users u on m.user_id = u.user_id WHERE group_id = $group_id";
include "../connection.php";
$result = $conn->query($sql);
$instant_messages = array();

while ($row = $result->fetch_assoc()) {
    $user_id = $row['user_id'];
    $first_name = $row['first_name'];
    $message = $row['message'];
    $time = $row['time'];
    $instant_messages[] = array('first_name' => $first_name, 'message' => $message, 'time' => $time);
}
print json_encode($instant_messages);
