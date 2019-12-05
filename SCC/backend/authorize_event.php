<?php 
require("authorize.php");
require("connection.php");

$user_id = $_SESSION["active_user"]["user_id"];

if(isset($_GET["event_id"])) {
	$event_id = $_GET["event_id"];
}
else if(isset($_POST["event_id"]))  {
	$event_id = $_POST["event_id"];
}
else {
	if(!isset($silent_auth)) {
		echo "No event id was provided";
		exit();
	}
}

$sql = "SELECT count(*) as 'permission' FROM events WHERE event_manager_id = $user_id AND event_id = $event_id";
$permission = $conn->query($sql)->fetch_assoc()['permission'];

if($permission == 0) {
	$sql = "SELECT count(*) as 'permission' FROM user_roles WHERE user_roles.user_id = $user_id";
	$permission = $conn->query($sql)->fetch_assoc()['permission'];
}


if($permission == 0) {
	if(!isset($silent_auth))
		header("Location: ../frontend/dashboard.php");
	if(isset($is_event_manager))
		unsset($is_event_manager);
}
else
	$is_event_manager = $event_id;

?>