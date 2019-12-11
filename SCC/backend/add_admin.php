<?php
/*
Author: Jesse Desmarais
ID: 40035761
this script will update the admin roles of a user or remove if we wish to unmake them an admin
*/

include("authorize_god.php");

$user_id = $_POST["user_id"];
$role = $_POST["role"];

$sql = "SELECT * FROM user_roles WHERE user_id = $user_id";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    if($role == 0) {
        $sql = "DELETE FROM user_roles WHERE user_id = $user_id";
    }
    else {
        $sql = "UPDATE user_roles SET role_id = $role WHERE user_id = $user_id";
    }
} 
else if ($role > 0) {
    $sql = "INSERT INTO `user_roles` (`user_role_id`, `user_id`, `role_id`) VALUES (NULL, $user_id, $role)";
}

$conn->query($sql);

$_SESSION["admin_create"] = true;
header("Location: ../frontend/add_admin.php");


?>