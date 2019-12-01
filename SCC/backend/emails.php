<?php	

function getEmails(){
    if(!isset($_SESSION)){
        session_start();
    }
    include ("connection.php");

    $user_id = $_SESSION['active_user']['user_id'];

	$sql = "SELECT * from emails Where receiver_id = $user_id";
	$results = $conn->query($sql);
	
	if($results != true)
		echo "Error: " . $sql . "<br>" . $conn->error;
	
    $conn->close();
    return $results;
}

?>