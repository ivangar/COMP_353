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

include("post-content.php");
include("display-post.php");

unset($_SESSION['error']);
?>