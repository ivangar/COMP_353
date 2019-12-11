<?php
/*
Author: Jesse Desmarais
ID: 40035761
Adds a users tag then returns them to the previous page
*/


if(!isset($_GET["type"]) || !isset($_GET["tag"]))
	exit();

include ("connection.php");

$type = $_GET["type"];
$tag = $_GET["tag"];
if($type == "group")
{
	if(!isset($_GET["group"]))
		exit();
	
	$group_id = $_GET["group"];
	$sql = "UPDATE `groups` SET `meta_data` = '$tag' WHERE `groups`.`group_id` = $group_id";
	$params = "type=group&group=".$group_id;
}
else if ($type == "user")
{
	if(!isset($_GET["user"]))
		exit();
	
	$user_id = $_GET["user"];
	$sql = "UPDATE `users` SET `meta_data` = '$tag' WHERE `users`.`user_id` = $user_id;";
	$params = "type=user&user=".$user_id;
}
$conn->query($sql);

//header("Location: ../frontend/tags.php?".$params);
echo "
<html>
	<head>
		<script>
			window.onload = goBack;
			function goBack() {
				window.location.replace('../frontend/tags.php?$params'); 
			}
		</script>
	</head>
<html>";

?>