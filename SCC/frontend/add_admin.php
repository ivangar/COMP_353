<?php
    include("../backend/authorize_god.php");
    require("navbar.php");
    if(isset($_SESSION["admin_create"])) {
        echo"<script> alert('Admin status modified successfully!');</script>";
        unset($_SESSION["admin_create"]);
    }
    


    if(isset($_GET["user_id"]))
    {
        $searched_user_id = $_GET["user_id"];

        $sql = "SELECT * FROM users JOIN user_roles ON user_roles.user_id = users.user_id WHERE users.user_id = $searched_user_id";
        $result =  $conn->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_name = $row["first_name"] . " " .$row["middle_name"] . " " . $row["last_name"];
            $role = $row["role_id"];
        }
        else {
            $sql = "SELECT * FROM users WHERE users.user_id = $searched_user_id";
            $result =  $conn->query($sql);

            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $user_name = $row["first_name"] . " " .$row["middle_name"] . " " . $row["last_name"];
                $role = 0;
            }
            else
            {
                echo "<script> alert('invalid user, Please enter a valid user')</script>";
                unset($searched_user_id);
            }
        }
    }
?>

<html>
<head>
    <title> Add Admin </title>
</head>
<body>

    <?php 
        if(isset($searched_user_id)) {
            echo " <form action='../backend/add_admin.php' method='POST'>";
            echo "Admin status for : $user_name <br>";
            echo "<input type='number' value= '$role' name='role' min='0' max='3' required/><br>";
            echo "<input type='hidden' value= '$searched_user_id' name='user_id' required/>";
            echo "<input type='submit' value='Update'/>";
        }
        else {
            echo "<form action='#' method='get'>";
            echo "Please enter user ID :<br>";
            echo "<input type='text' name='user_id' required/> ";
            echo "<input type='submit' value='Seach'/>";
        }
    ?>
    </form>

</body>
</html>

