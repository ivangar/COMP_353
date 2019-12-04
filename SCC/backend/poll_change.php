<?php
session_start();
include("connection.php");
if(!isset($_SESSION['active_user']))
{
	header("Location: ../frontend/dashboard.php");
}

$user_id = $_SESSION['active_user']['user_id'];
$poll_id = $_POST["id"];

$sql = "SELECT end_date FROM `poll` WHERE poll_id = $poll_id";
$result = $conn->query($sql);
$today = strtotime("now");
$end = strtotime($result->fetch_assoc()["end_date"]);

if($today < $end) {
	$sql = "Delete FROM poll_results WHERE poll_id = $poll_id AND user_id = $user_id";
	$conn->query($sql);
	header("Location: ../frontend/poll.php?poll_id=$poll_id");

}

?>