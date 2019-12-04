<?php 
require("authorize.php");
require("connection.php");

$user_id = $_SESSION["active_user"]["user_id"];
$sql = "SELECT COUNT(*) AS 'permission' FROM user_roles WHERE user_id = $user_id AND role_id > $admin_type";

$permission = $conn->query($sql)->fetch_assoc()['permission'];

if ($permission == 0) {
	  header("Location: ../frontend/dashboard.php");
}
?>