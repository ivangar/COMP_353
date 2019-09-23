<?php

/*
    Comp353 Group 7 Project 1
	27043651 Nicolas Brodeur-Champagne
	27502303 Siamak Samie
	27006284 Ivan Garzon
	26854486 Ragith Sabapathipillai
	40035761 Jesse Desmarais
*/

$servername = "localhost";
$username = "root";
$password = "";
$db = "comp353";


// Creating connection
$conn = new mysqli($servername, $username, $password);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS comp353";
if ($conn->query($sql) === TRUE) {
    echo "comp353 database created successfully";
} else {
    echo "Error creating comp353 database: " . $conn->error;
}

// Creating tables if doesn't exist 

$conn->select_db('comp353');

//table user
$sql = "CREATE TABLE IF NOT EXISTS user (
    lastname VARCHAR(30) NOT NULL,
    firstname VARCHAR(30) NOT NULL,
    middle_name VARCHAR(30),
    userID INT(10) PRIMARY KEY NOT NULL,
    pass VARCHAR(30) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "<br>";
        echo "Table 'user' created successfully";
    } else {
        echo "<br>";
        echo "Error creating table: " . $conn->error;
    }

$sql = "CREATE TABLE IF NOT EXISTS roles (
    roleID INT(10) PRIMARY KEY NOT NULL,
    description VARCHAR(30)
    )";

    if ($conn->query($sql) === TRUE) {
        echo "<br>";
        echo "Table 'roles' created successfully";
    } else {
        echo "<br>";
        echo "Error creating table: " . $conn->error;
    }

//table event_info
$sql = "CREATE TABLE IF NOT EXISTS event_info (
    eventName VARCHAR(30) NOT NULL,
    eventId INT(10) PRIMARY KEY NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE,
    adminUserID INT(10) NOT NULL,
    roleID INT(10) NOT NULL,
    CONSTRAINT `fk_event_info_user`
        FOREIGN KEY (adminUserID) REFERENCES user (userID)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT `fk_event_info_roles`
        FOREIGN KEY (roleID) REFERENCES roles (roleID)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
    )";

    if ($conn->query($sql) === TRUE) {
        echo "<br>";
        echo "Table 'event_info' created successfully";
    } else {
        echo "<br>";
        echo "Error creating table: " . $conn->error;
    }

//table participant
$sql = "CREATE TABLE IF NOT EXISTS participant (
    userID INT(10) NOT NULL,
    eventID INT(10) NOT NULL,
    PRIMARY KEY (userID, eventID),
    CONSTRAINT `fk_participant_user`
        FOREIGN KEY (userID) REFERENCES user (userID)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT `fk_participant_event_info`
        FOREIGN KEY (eventID) REFERENCES event_info (eventId)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
    )";

    if ($conn->query($sql) === TRUE) {
        echo "<br>";
        echo "Table 'participant' created successfully";
    } else {
        echo "<br>";
        echo "Error creating table: " . $conn->error;
    }

//putting CSV content into mysql db

/*
The CSV file is divided into 3 parts. Each section seperated by a line in array position 0.
On each line we can check if array position 0 is set to know when to switch which table we're inserting the data into.
the first line after each section is just a description of the content so we can skip that.
*/

echo "<br>";  
echo "<br>";  

$section = 0; //variable used to distiguish between the 3 sections

//open the csv file
if (($h = fopen($_POST["file_path"], "r")) !== FALSE) 
{
  //get each line as an array seperated by an "|"  
  while (($data = fgetcsv($h, 1000, "|")) !== FALSE) 
  {		

    //Each section is seperated by a value in the 0 index, we use this to increment the section number
    if ($data[0]!=""){
        $section++;
    }
    // Ignoring the lines of column titles. No need to store that in DB
    else if ((isset($data[4]) ? $data[4] : null) == "userID" || (isset($data[2]) ? $data[2] : null) == "EventID" || (isset($data[1]) ? $data[1] : null) == "RoleID"){
        // do nothing
    }

    else if($section==1){   

        $lastname = !empty($data[1]) ? "'$data[1]'" : "NULL";
        $firstname = !empty($data[2]) ? "'$data[2]'" : "NULL";
        $middle_name = !empty($data[3]) ? "'$data[3]'" : "NULL";
        $userID = !empty($data[4]) ? "'$data[4]'" : "NULL";
        $pass = !empty($data[5]) ? "'$data[5]'" : "NULL";

        //check if there aren't any users already registered in the table with the id from the csv file
        $search_user_qry = "SELECT * FROM user WHERE user.userID = $userID";

        if($result = $conn->query($search_user_qry) ){
            if($result->num_rows == 0){
                $sql = "INSERT INTO user (lastname, firstname, middle_name, userID, pass) VALUES ($lastname, $firstname, $middle_name, $userID, $pass)";
                if ($conn->query($sql) != TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }


    }

    else if($section==2){

        $roleID = !empty($data[1]) ? "'$data[1]'" : "NULL";
        $description = !empty($data[2]) ? "'$data[2]'" : "NULL";

        //check if there aren't any admins already registered in the table with the admin id from the csv file
        $search_admins_qry = "SELECT * FROM roles WHERE roles.roleID = $roleID";

        if($result = $conn->query($search_admins_qry) ){
            if($result->num_rows == 0){
                $sql = "INSERT INTO roles (roleID, description) VALUES ($roleID, $description)";
                if ($conn->query($sql) != TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }

    else if($section==3){

        $eventName = !empty($data[1]) ? "'$data[1]'" : "NULL";
        $eventID = !empty($data[2]) ? "'$data[2]'" : "NULL";
        $startDate = !empty($data[3]) ? "'$data[3]'" : "NULL";
        $endDate = !empty($data[4]) ? "'$data[4]'" : "NULL";
        $adminUserID = !empty($data[5]) ? "'$data[5]'" : "NULL";
        $roleID = !empty($data[6]) ? "'$data[6]'" : "NULL";

        //check if there aren't any admins already registered in the table with the admin id from the csv file
        $search_admins_qry = "SELECT * FROM event_info WHERE event_info.adminUserID = $adminUserID";

        if($result = $conn->query($search_admins_qry) ){
            if($result->num_rows == 0){
                $sql = "INSERT INTO event_info (eventName, eventID, startDate, endDate, adminUserID, roleID) VALUES ($eventName, $eventID, $startDate, $endDate, $adminUserID, $roleID)";
                if ($conn->query($sql) != TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
    
    else if($section==4){

        $userID = !empty($data[1]) ? "'$data[1]'" : "NULL";
        $eventID = !empty($data[2]) ? "'$data[2]'" : "NULL";

        //check if there aren't any participants already registered in the table with the admin id from the csv file
        $search_participant_qry = "SELECT * FROM participant WHERE participant.userID = $userID AND participant.eventID = $eventID";

        if($result = $conn->query($search_participant_qry) ){
            if($result->num_rows == 0){
                    $sql = "INSERT INTO participant (userID, eventID) VALUES ($userID, $eventID)";
                    if ($conn->query($sql) != TRUE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            }
        }


    }
    


  }

  echo "Copying contents from CSV to mysql complete";

  fclose($h);
}

$conn->close();
?>