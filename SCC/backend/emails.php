<?php	

function getEmails($userEmails){
    include ("connection.php");

	$sql = "SELECT * from emails Where user_email = $userEmails";
	$results = $conn->query($sql);
	
	if($results != true)
		echo "Error: " . $sql . "<br>" . $conn->error;
	
    $conn->close();
    return $results;
}

?>