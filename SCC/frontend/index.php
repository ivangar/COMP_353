<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['active_user']))
{
	header("Location: dashboard.php");
}
else
{
	echo
	"
	<div class='container'>
	    <div class='login-container'>
	        <h1>S.C.C.</h1>
            <div id='output'></div>
            <img src='data:image/jpeg;base64,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' class='avatar'></img>
            <div class='form-box'>
                <form action='../backend/authenticate.php' method='post' enctype='multipart/form-data'>
                    <input type='text' name='login_username' id='login_username' placeholder='User ID'/>
                    <input type='password' name='login_password' id='login_password' placeholder='Password'/>
                    <button class='btn btn-info btn-block login' type='submit'>Login</button>
                </form>
            </div>
        </div>    
    </div>
	
	";
}
?>
</body>

</html>