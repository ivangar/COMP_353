<?php
include("connection.php");
session_start();

if(!isset($_SESSION['active_user']))
{
	header("Location: ../frontend/dashboard.php");
}


$user_id = $_SESSION['active_user']['user_id'];
$poll_id = $_POST['id'];
$selection = $_POST['vote'];

$sql = "INSERT INTO `poll_results` (`poll_result_id`, `poll_id`, `user_id`, `option_selected`) VALUES (NULL, '$poll_id', '$user_id', '$selection')";
$conn->query($sql);
//header("Location: ../frontend/poll.php?poll_id=$poll_id");

?>