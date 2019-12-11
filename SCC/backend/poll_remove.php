<?php
/*
Author: Jesse Desmarais
ID: 40035761
Page is called when we want to remove a poll
*/

include("connection.php");
$poll_id = $_POST["id"];

$sql = "DELETE FROM `poll` WHERE `poll`.`poll_id` = $poll_id";
//echo $sql; 
$conn->query($sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>