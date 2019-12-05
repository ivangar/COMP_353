<?php
include("authorize_god.php");

$user_id = $POST["user_id"];
$role = $POST["role"];

$sql = INSERT INTO `user_roles` (`user_role_id`, `user_id`, `role_id`) VALUES (NULL, $user_id, $role);
$conn->query($sql);
header("Location: ../frontend/add_admin.php");


?>