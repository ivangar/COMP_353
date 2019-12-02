<?php
//start session
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['error'])){
	$error = $_SESSION['error'];
	echo "<span>$error</span>";
}
$event_id = $_GET['event_id'];

include("navbar.php");
if(isset($_GET['create-group']) && $_GET['create-group'] == "true"){
	include("create-group.php");
}
include("post-content.php");
include("display-post.php");

unset($_SESSION['error']);
?>