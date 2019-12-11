<?php 
/*
Author: Jesse Desmarais
ID: 40035761
Authorizes an event manager to see a group report
*/

require("authorize.php");
require("connection.php");

$user_id = $_SESSION["active_user"]["user_id"];

if(isset($_GET["group_id"])) {
	$group_id = $_GET["group_id"];
}
else if(isset($_POST["group_id"]))  {
	$group_id = $_POST["group_id"];
}
else {
	echo "No Group id was provided";
	exit();
}

$sql = "SELECT COUNT(*) AS 'permission' FROM groups JOIN events ON events.event_id = groups.event_id WHERE groups.group_id = $group_id AND events.event_manager_id = $user_id";
echo $sql."<br>";

$permission = $conn->query($sql)->fetch_assoc()['permission'];

if ($permission == 0) {
	$sql = "SELECT COUNT(*) AS 'is_admin' FROM user_roles WHERE user_roles.user_id = $user_id";
	$is_admin = $conn->query($sql)->fetch_assoc()['is_admin'];
	if($is_admin == 0) {
		header("Location: ../frontend/dashboard.php");
	}
}

?>