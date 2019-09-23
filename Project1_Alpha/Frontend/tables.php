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
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db('comp353');

$table = $_GET["table"];
$name_query = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'comp353' AND TABLE_NAME = '$table'");

while($row = $name_query->fetch_assoc()){
    $name_column[] = $row;
}

 $table_names = array_column($name_column, 'COLUMN_NAME');

?>

<html>

<head> 
    <title> p1- users </title>
    <style>
    th{
        text-align: left; 
        padding-right:50px;
    }
    </style>
</head>
<body>
    <h1><?php echo $table; ?></h1>
    <table>
    <tr>
        <?php 
        foreach($table_names as $name)
            echo "<th>" . $name . "</th>";
        
        ?>
    </tr>
     <?php
        $sql = "SELECT * FROM $table";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach($table_names as $name)
                    echo "<td>" . $row[$name] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }


        ?>
    </table>
</body>

</html>