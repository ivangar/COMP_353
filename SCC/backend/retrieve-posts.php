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
if (isset($_GET['event_id'])) {
	$event_id = $_GET['event_id'];
} else {
	$event_id = "";
}

$sql = "SELECT users.first_name, users.middle_name, users.last_name, posts.post_content, posts.post_image, posts.upload_date, posts.post_permission, posts.post_id FROM posts INNER JOIN users on posts.user_id = users.user_id WHERE posts.group_id = $group_id ORDER BY posts.upload_date DESC";


$result = $conn->query($sql);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
if($result -> num_rows > 0){
	while ($row = $result-> fetch_assoc()) {
		echo "<div class='post'>";
 		if($row['post_content'] != NULL){
			echo "<div class='post_content'>" 
			.$row['post_content']. 
			"</div>";
		}
		if ($row['post_image'] != NULL) {
			echo "<div class='post_media'><img height='250px'; src=../uploads/" . $row['post_image'] . "></div>"; 
		}
		echo "<div class=post_data-container><div class='post_user'>" . $row['first_name'] . " " . $row['last_name'] . "</div>" . "<div class='post_date'>" . $row['upload_date'] . "</div></div>";
		if ($row['post_permission'] == 1){
			echo "<div><form method='POST' action=../backend/add-comment.php><input placeholder='leave a comment' id='comment' name='comment' type='text'><input type='hidden' name='post_id' value=" . $row['post_id'] . "><input type='hidden' name='group_id' value=" . $group_id . "><input type='hidden' name='event_id' value=" . $event_id . "></form></div>";
		}
		echo "Comments";
		$postId = $row['post_id'];
		include('retrieve-comments.php');
		echo "</div>";
	}
} else {

}
$conn->close();
?>