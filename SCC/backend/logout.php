<?php 
/*
Author: Ivan Garzon
ID: 27006284
Logout script
*/
session_start();
if(isset($_SESSION['active_user']))
{
	unset($_SESSION['active_user']);
}
header("Location: ../frontend/index.php"); ?>