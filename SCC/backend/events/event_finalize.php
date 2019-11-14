<?php
include("../connection.php");
$event_name = $_POST['event_name'];
$event_location = $_POST['event_location'];
$event_start = $_POST['event_start'];
$event_end = $_POST['event_end'];
$event_id = $_POST['event_id'];
echo "$event_id";
$sql = "UPDATE events SET event_name='$event_name', start_date='$event_start', end_date='$event_end', status = '1' WHERE event_id = '$event_id'";

if($conn->query($sql) === TRUE) {
    echo "new record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

