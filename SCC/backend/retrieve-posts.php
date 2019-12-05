<?php
include "connection.php";

//start session
if (!isset($_SESSION)) {
    session_start();
}
//check that user is logged in
if (!isset($userid)) {
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
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $postId = $row['post_id'];

        echo "<div class='card border border-primary mb-3 mt-3'>";

		
        echo "	<div class='card-body pl-4 pr-4'>
		<h5 class='card-title font-weight-bold pl-1'>" . $row['first_name'] . " " . $row['last_name'] . "<small class='font-weight-light pl-2'>" . $row['upload_date'] . "</small></h5>";
		
		if ($row['post_image'] != null) {
			echo "<img class='m-4' width='250px' src=../uploads/" . $row['post_image'] . ">";
		}
		
        if ($row['post_content'] != null) {
            echo "<p class='card-text pl-4 alert alert-primary'>" . $row['post_content'] . "</p>";
        }
        if ($row['post_permission'] != 0) {

            echo "<form method='POST' action=../backend/add-comment.php>
			<textarea class='form-control' rows='2' name='comment' id='comment' placeholder='comment'></textarea>
			<input type='hidden' name='post_id' value=" . $row['post_id'] . ">
			<input type='hidden' name='group_id' value=" . $group_id . ">
			<input type='hidden' name='event_id' value=" . $event_id . ">
			<input type='submit' name='submit' class='btn btn-primary btn-block mt-2'/>
			</form>";
        }

        echo "</div><ul class='list-group list-group-flush pl-4 pr-4'>";
        include 'retrieve-comments.php';
        echo "</ul></div>";
    }

} else {

}
$conn->close();
