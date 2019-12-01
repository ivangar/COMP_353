<?php
include "../connection.php";

session_start();

$group_id = $_POST['group_id'];
$user_id = $_SESSION['active_user']['user_id'];
$message = $_POST['message'];

// TODO: do if user_id exists in the group. else no

$sql = "INSERT INTO instant_messages (group_id, user_id, message) VALUES ($group_id, $user_id, '$message')";

if ($conn->query($sql) != true) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    echo "success";
}

$conn->close();
