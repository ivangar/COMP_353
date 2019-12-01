<?php

session_start();
$user_id = $_SESSION['active_user']['user_id'];

// TODO: get if user_id exists in the group. else no

$sql = "SELECT * FROM instant_messages WHERE group_id = $group_id";

$result = $conn->query($sql);
$instant_messages = array();

while ($row = $result->fetch_assoc()) {
    $instant_messages[] = $row;
}
print json_encode($instant_messages);
