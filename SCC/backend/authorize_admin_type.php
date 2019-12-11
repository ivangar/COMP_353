<?php 
/*
Author: Jesse Desmarais
ID: 40035761
Checks the authorization level set by the previous admin scripts
*/

require("authorize.php");
require("connection.php");

$user_id = $_SESSION["active_user"]["user_id"];
$sql = "SELECT COUNT(*) AS 'permission' FROM user_roles WHERE user_id = $user_id AND role_id > $admin_type";

$permission = $conn->query($sql)->fetch_assoc()['permission'];

if ($permission == 0) {
	if(!isset($silent_auth))
	  header("Location: ../frontend/dashboard.php");
}
else
	$is_admin = $admin_type;
?>