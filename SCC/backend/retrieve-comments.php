<?php
include("connection.php");
//start session
if(!isset($_SESSION)){
    session_start();
}
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

$sqlComment = "SELECT * \n"

    . "FROM `comments`\n"

    . "INNER JOIN `posts`\n"

    . "ON `comments`.`post_id` = `posts`.`post_id`\n"

    . "INNER JOIN `users`\n"

    . "ON `comments`.`user_id` = `users`.`user_id`\n"

    . "WHERE `posts`.`post_id` = $postId";

$resultComment = $conn->query($sqlComment);
if (!$resultComment) {
    trigger_error('Invalid query: ' . $conn->error);
}
if($resultComment -> num_rows > 0){
	while ($rowComment = $resultComment-> fetch_assoc()) {
		echo "<div><div>". $rowComment['comment'] . $rowComment['comment_date'] . "</div>" . "<div>by " . $rowComment['first_name'] . $rowComment['middle_name'] . $rowComment['last_name'] . "</div></div>";
	}
}

?>