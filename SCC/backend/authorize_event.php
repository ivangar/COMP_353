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
	echo "No event id was provided";
	exit();
}

$sql = "SELECT count(*) as 'permission' FROM events, user_roles WHERE user_roles.user_id = $user_id OR event_manager_id = $user_id AND event_id = $event_id";
$permission = $conn->query($sql)->fetch_assoc()['permission'];

if($permission == 0) {
	if(!isset($silent_auth))
		header("Location: ../frontend/dashboard.php");
	else
		$is_event_manager = true;

}

?>