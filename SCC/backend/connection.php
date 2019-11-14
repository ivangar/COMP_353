<?php
$servername = "107.180.50.224";
$username = "muigi";
$password = "admin123";
$db = "scc_db";



// Creating connection
$conn = new mysqli($servername, $username, $password);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//For now I commented these, cauz it was printing the successful message every time
/*else{
    echo "Connected successfully";
}*/
$conn->select_db('scc_db');
?>
