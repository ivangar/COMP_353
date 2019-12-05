<?php

if(!isset($_GET["group_id"]))
	exit();
include("connection.php");

$group_id = $_GET["group_id"];

if(isset($_GET["search"])) {
	$search_query = $_GET["search"];
	if($search_query != "")
		echo "Users with tags containing : $search_query <br>";
}
else
	$search_query = "";

$sql = "SELECT first_name , middle_name, last_name, users.user_id FROM `users` JOIN group_members ON users.user_id = group_members.user_id WHERE group_members.group_id = $group_id AND group_members.participant_status_id = 1 AND users.meta_data LIKE '%$search_query%'";
$group_members = $conn->query($sql);

echo "Number of users ". $group_members->num_rows . "<br>";

while($row = $group_members->fetch_assoc()) {
	$user_id = $row["user_id"];
	$sql = "SELECT upload_date FROM posts where user_id = $user_id ORDER BY `upload_date` DESC limit 1";
	$last_post_date = $conn->query($sql)->fetch_assoc()["upload_date"];
	$sql = "SELECT count(*) AS 'posts' FROM posts where user_id = $user_id AND group_id = $group_id";
	$post_count = $conn->query($sql)->fetch_assoc()["posts"];
	$sql = "SELECT Count(*) AS 'comments' FROM comments JOIN posts ON posts.post_id = comments.post_id WHERE comments.user_id = $user_id AND posts.group_id = $group_id";
	$comment_count = $conn->query($sql)->fetch_assoc()['comments'];
	echo $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"] . "<br>";
	echo "*	last posted on : $last_post_date <br>";
	echo "*	Has a total of $post_count posts<br>";
	echo "*	Has a total of $comment_count comments<br>";
}


?>