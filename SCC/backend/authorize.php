<?php 

if(!isset($_SESSION)) {
	session_start();
}

if(!isset($_SESSION['active_user'])) {
	
	$_SESSION['error'] = "no_login";
	header('Location: ../frontend/index.php');
}


?>