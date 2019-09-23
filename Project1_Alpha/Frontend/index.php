<html>
	<!-- Comp353 Group 7 Project 1 -->
	<!-- 27043651 Nicolas Brodeur-Champagne -->
	<!-- 27502303 Siamak Samie -->
	<!-- 27006284 Ivan Garzon -->
	<!-- 26854486 Ragith Sabapathipillai -->
	<!-- 40035761 Jesse Desmarais -->
	<head>
		<title> p1 -index </title>
		<style>
			a{
				margin-right:20px;
			}
		</style>
	</head>

	<body>	
		<form action="../Backend/CSVloader.php" method="POST">
			Select image to upload:
			<input type="file" name="file_path" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		</form>
		
		<div>
			<a href="tables.php?table=user"> Go to users </a>
			<a href="tables.php?table=event_info"> Go to events </a>
			<a href="tables.php?table=participant"> Go to participant </a>
		</div>
	</body>

</html>