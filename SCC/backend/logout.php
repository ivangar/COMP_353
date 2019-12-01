<?php 
session_start();
if(isset($_SESSION['active_user']))
{
	unset($_SESSION['active_user']);
}
header("Location: ../frontend/index.php"); ?>