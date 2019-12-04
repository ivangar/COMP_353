<?php 
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

$sql = "SELECT * FROM group_members WHERE group_id = $group_id AND user_id = $user_id And participant_status_id = 1";
echo $sql."<br>";

$permission = $conn->query($sql)->fetch_assoc()['permission'];

if ($permission == 0) {
	  header("Location: ../frontend/dashboard.php");
}

?>