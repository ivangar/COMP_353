<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "scc_db";


// Creating connection
$conn = new mysqli($servername, $username, $password);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "Connected successfully";
}
$conn->select_db('scc_db');
?>
