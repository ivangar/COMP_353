<?php 
/*
Author: Jesse Desmarais
ID: 40035761
Checks if the useris logged in, if not we send them to login page.
*/
if(!isset($_SESSION)) {
	session_start();
}

if(!isset($_SESSION['active_user'])) {
	
	$_SESSION['error'] = "no_login";
	header('Location: ../frontend/index.php');
}
?>