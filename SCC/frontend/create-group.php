<?php
require "HotReloader.php";
use HotReloader\HotReloader;
$reloader = new HotReloader();
$reloader->init();
$event_id;
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
	</style>
</head>
<body>
<form method="POST">
	<div class="form-title">
		Select users to create group with: 
	</div>
	<?php
		$groupId = $_GET['group_id'];
		$sql = "SELECT `users`.`user_id`, `users`.`first_name`, `users`.`middle_name`, `users`.`last_name`, `group_members`.`group_members_id`\n"

    . "FROM `group_members`\n"

    . "INNER JOIN users ON `group_members`.`user_id` = `users`.`user_id`\n"

    . "WHERE `group_members`.`group_id` = $groupId";

    $result = $conn->query($sql);
	if (!$result) {

	}
	if($result -> num_rows > 0){
		while ($row = $result-> fetch_assoc()) {
			echo "<div><input type='checkbox' name='userSelected' value=" . $row['user_id'] . "> " . $row['first_name'] . $row['middle_name'] . $row['last_name'] . "</div>"; 
		}
	} 
	?>
	<button>Create Group</button>
</form>
</body>
</html>