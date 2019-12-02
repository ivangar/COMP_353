<?php 
require("navbar.php");
$event_id = $_GET["event_id"];
$action_url = "action='../backend/add_users.php?event_id=$event_id'";
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Add users</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style> 
    #loading_msg { 
    	position: absolute;
  		left: 400px;
  		top: 35px;
      	display: none;
    } 
</style> 
</head>

<body>
	<div id="loading_msg"><img src="images/spinner.gif" height="75" width="75"></div>
	<table width="600" style="padding-top:30px;">
	<form <?php echo $action_url; ?> method="post" name="add_users_form" id="add_users_form" enctype="multipart/form-data">
	<tr>
	<td width="20%">Select file</td>
	<td width="80%"><input type="file" name="user_file" id="file" /></td>
	</tr>

	<tr>
	<td>Submit</td>
	<td><input type="submit" name="submit" /></td>
	</tr>

	</form>
	<tr>
	<td></td>
	<td><button onclick="goBack()">Cancel</button></td>
	</tr>

	</table>
	  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	  <script type="text/javascript">
		$(document).ready(function () {
	      	$( "#add_users_form" ).submit(function( event ) {
	      		$("#loading_msg").show(100); 
	      	});
		});//end document.ready

		</script>
</body>

</html>