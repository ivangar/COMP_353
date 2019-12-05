<?php
//require("../backend/polldata.php");
include("../backend/connection.php");
//session_start();
/*
if(!isset($_SESSION['active_user']))
{
	header("Location: ../frontend/dashboard.php");
}*/

$user_id = $_SESSION['active_user']['user_id'];

$sql = "SELECT * FROM poll WHERE group_id = $group_id";
$polls = $conn->query($sql);
while($poll_data = $polls->fetch_assoc()) {

	$options = explode(";", $poll_data["options"]);
	$optionCount = 1;
	$today = strtotime("now");
	$end = $poll_data["end_date"];
	$poll_id = $poll_data["poll_id"];

	if($today < strtotime($end))
		$stillAvailable = true;
	else
		$stillAvailable = false;


	echo  $poll_data['title']."<br>";

	$sql = "SELECT option_selected FROM poll_results WHERE poll_id = $poll_id and user_id = $user_id";
	$result = $conn->query($sql);
	if($result->num_rows > 0 || !$stillAvailable) {
		echo "Poll results  <br>";
		$our_selection = $result->fetch_assoc()["option_selected"];
		foreach($options as $option){
			if($optionCount == $our_selection)
				echo "<b>".$option. "</b> : ";
			else
				echo $option . " : ";
			$sql = "SELECT count(option_selected) as votes FROM `poll_results` WHERE option_selected = ". $optionCount++;
			$vote_count = $conn->query($sql)->fetch_assoc()["votes"];
			echo $vote_count."<br>";
		}
		
		if($stillAvailable) {
			echo "Ends in :". $end;

			echo "<form action='../backend/poll_change.php' method='POST'>
				<input type='hidden' name='id' value ='$poll_id'/>
				<br>  <input type='submit' value='Change Vote'></form>
			";
		}
	}
	else {
		if(count($options) > 1) {
			echo "<form action='../backend/poll_submit.php' method='POST'>";
			foreach($options as $option){
				echo "<input type='radio' name='vote' value='".$optionCount++."'/>$option<br> ";
			}
			echo "<input type='hidden' name='id' value ='$poll_id'/>
					<br>  <input type='submit' value='Submit'>
					</form> ";
		}
	}
}
?>
