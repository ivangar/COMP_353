<?php
if(!isset($_SESSION)){
    session_start();
}
require("../backend/connection.php");
include("navbar.php");
$event_id = $_GET['event_id'];

//check that user is logged in
if(!isset($userid)){
    $userid = $_SESSION['active_user']['user_id'];
} else {
    $_SESSION['error'] = "Error - No user logged in";
}
if(isset($_GET['create-group']) && $_GET['create-group'] == "true"){
	
	$main_group_id = 0;
	$sql = "SELECT primary_event_group_id FROM events WHERE event_id = $event_id";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) { 
			$main_group_id = $row["primary_event_group_id"];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	  <style type="text/css">
		h3{ 
			text-align: center; 
		}
		div.container{
			margin: auto; 
			width: 50%;
		}
		table{
			text-align: left;
		}
		.right {
		  position: absolute;
		  right: 0px;
		  padding: 10px;
		}
	</style>
</head>
<body>
<h3 >Create Group</h3>
<div class="container">
<form class="group-form" method="POST" action="../backend/groupMaker.php" name="create_group_form" id="create_group_form">
	<input type="hidden" name="event_id" value=<?php echo $event_id; ?>>
	<fieldset>
		<legend>Group details</legend>
			<table cellpadding='10' style='text-align: left;'>
				<tbody>
					<tr>
						<td><label id="group_name">Group Name</label></td>
						<td><input required="" id="group_name" type="text" name="group_name"></td>
					</tr>
					<tr>
						<td><label id="group_details">Group Description</label></td>
						<td><input required="" id="group_details" type="text" name="group_details"></td>
					</tr>
				</tbody>
			</table>
	</fieldset>
	<div style='padding-top:30px;'>
		<fieldset>
			<legend>Select members of your new group </legend>
				<table cellpadding='10' style='text-align: left;'>
					<thead>
						<tr>
						  <th>Name</th>
						  <th>Address</th>
						  <th>Date of birth</th>
						  <th>Email</th>
						</tr>
					</thead>
					<tbody>
					<?php
								$sql = "SELECT `users`.`user_id`, `users`.`first_name`, `users`.`middle_name`, `users`.`last_name`, `users`.`address`, `users`.`date_of_birth`, `users`.`email`, `group_members`.`group_members_id`\n"

							. "FROM `group_members`\n"

							. "INNER JOIN users ON `group_members`.`user_id` = `users`.`user_id`\n"

							. "WHERE `group_members`.`group_id` = $main_group_id";

							$result = $conn->query($sql);
							if($result -> num_rows > 0){
								while ($row = $result-> fetch_assoc()) {
									echo "<tr><td><input type='checkbox' name='userSelected[]' value=" . $row['user_id'] . "> " . $row['first_name'] . " ". $row['middle_name'] . " ". $row['last_name'] . "</td>"; 
									echo "<td>".$row['address']."</td>"; 
									echo "<td>".$row['date_of_birth']."</td>"; 
									echo "<td>".$row['email']."</td></tr>";
								}
							} 
						?>
					</tbody>
				</table>
		</fieldset>
	</div>
	<div style='padding-top:30px;'>
		  <table cellpadding='10' style='text-align: left;'>
			<tbody>
			  <tr>
			  <td><button type="submit">Create Group</button></td>
			  </tr>
			</tbody>
		  </table>
	</div>
</form>
</div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(document).ready(function () {
		
		var event_id = <?php echo $event_id; ?>;
		
		$( "#create_group_form" ).submit(function( event ) {
			  group_data = $("#create_group_form").serializeArray();
		    
			event.preventDefault();

		    $.ajax({
              url: "../backend/groupMaker.php",
              cache: false,
              type: "POST",
              dataType: "html",
              data: group_data
            }) 
            .done(function( data ) {
             	if(isNaN(data)) {
					alert(data);
				}
				
                else {
					alert("group has been created");
					window.location.href = "event_home.php?event_id="+event_id+"&group_id="+data;
				}
            })
            .fail(function() {
                alert("the group was not created"); 
            }); //ajax call
		});
      
	});//end document.ready
  </script>
</body>
</html>
<?php }?>