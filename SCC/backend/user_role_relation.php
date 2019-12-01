<?php
/*
-----------------------------------------------------------------------------------
Created by Ragith November 17, 2019

Purpose: Extract users and roles relationship data

Description: File returns the user_roles data from the user_id passed in

How to use: Pass a user id using the $userid variable, or by default session userid will be used. 

Returned data:
	$userId: user id found from the users table
	$groupId: group id found from the user_roles table
	$roleId: role id foun from the user_roles table
-----------------------------------------------------------------------------------

*/
	if(!isset($_SESSION)){
		session_start();
	}
	include("connection.php");

	if(!isset($userid)){
		$userid = $_SESSION['active_user']['user_id'];
	}

	$sql = "SELECT users.user_id, user_roles.groupId, user_roles.roleId\n"

	    . "FROM users\n"

	    . "INNER JOIN user_roles ON users.user_id = user_roles.userId\n"

	    . "WHERE userId = $userid";

	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
		$userId = $row['user_id'];
		$groupId= $row['groupId'];
		$roleId = $row['roleId'];
	}

?>