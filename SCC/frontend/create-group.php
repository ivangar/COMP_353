<?php
$event_id;

//check that user is logged in
if(!isset($userid)){
    $userid = $_SESSION['active_user']['user_id'];
} else {
    $_SESSION['error'] = "Error - No user logged in";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.form-title {
			width: fit-content;
			margin: auto;
			font-weight: 800;
		}
		.group-form {
			height: 200px;
		}
		label {
			margin-top: 5px;
		}
		button {
			margin-top: 10px;
		}
	</style>
</head>
<body>
<form class="group-form" method="POST" action="../backend/groupMaker.php">
	<div class="form-title">
		Select users to create group with: 
	</div>
	<?php
		$groupId = $_GET['group_id'];
		$sql = "SELECT `users`.`user_id`, `users`.`first_name`, `users`.`middle_name`, `users`.`last_name`, `group_members`.`group_members_id`\n"

    . "FROM `group_members`\n"

    . "INNER JOIN users ON `group_members`.`user_id` = `users`.`user_id`\n"

    . "WHERE `group_members`.`group_id` = $groupId AND NOT `users`.`user_id`=$userid";

    $result = $conn->query($sql);
	if (!$result) {

	}
	if($result -> num_rows > 0){
		while ($row = $result-> fetch_assoc()) {
			echo "<div><input type='checkbox' name='userSelected[]' value=" . $row['user_id'] . "> " . $row['first_name'] . $row['middle_name'] . $row['last_name'] . "</div>"; 
		}
	} 
	?>
	<label id="group_name">Group Name</label>
	<input required="" id="group_name" type="text" name="group_name">

	<label id="group_details">Group Description</label>
	<input required="" id="group_details" type="text" name="group_details">

	<input type="hidden" name="event_id" value=<?php echo $_GET['event_id']; ?>>
	<button>Create Group</button>
</form>
</body>
</html>