<?php
include("connection.php");
//start session
if(!isset($_SESSION)){
    session_start();
}
//check that user is logged in
if(!isset($userid)){
    $userid = $_SESSION['active_user']['user_id'];
} else {
    $_SESSION['error'] = "Error - No user logged in";
}

$group_id = $_POST['group_id'];
$event_id = $_POST['event_id'];
$postId = $_POST['post_id'];
$comment = $_POST['comment'];

$sql = "INSERT INTO `comments`(`post_id`,`user_id`,`comment`) VALUES($postId, $userid, '$comment')";
$result = $conn->query($sql);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
if($result){
	header("Location: ../frontend/event_home.php?event_id=".$event_id . "&" . "group_id=". $group_id);
}

?>