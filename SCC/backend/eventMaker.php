<?php
include("connection.php");
$event_manager = $_POST['user_id'];
$event_fee = $_POST['event_fee'];

switch ($_POST["event_type"]) {
	case 'non-profit_recurrent':
		$event_id = "2";
		break;
	case 'non-profit':
		$event_id = "4";
		break;
	case 'private_recurrent':
		$event_id = "1";
		break;
	case 'private':
		$event_id = "3";
		break;
	default:
		break;
}


$sql = "INSERT INTO events (event_payment_id, event_type_id, resource_id, event_manager_id, location_id, status, total_cost) VALUES ('1', '$event_id', '1', '$event_manager', '1', '2', '$event_fee')";

if($conn->query($sql) === TRUE) {
	header("Location: ../frontend/dashboard.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>