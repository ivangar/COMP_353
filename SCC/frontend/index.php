<html>
<head>
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
	<table width='600'>
	<form action='../backend/authorize.php' method='post' enctype='multipart/form-data'>
	<tr>
	<td width='20%'>Login</td>
	</tr>
	<tr>
	<td width='20%'>Username : <input type='text' name='login_username' id='login_username'/></td>
	</tr>
	<tr>
	<td width='20%'>Password : <input type='password' name='login_password' id='login_password'/></td>
	</tr>

	<tr>
	<td><input type='submit' name='submit' /></td>
	</tr>

	</form>
	</table>";
}
?>
</body>

</html>