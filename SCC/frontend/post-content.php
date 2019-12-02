<?php 
include("navbar.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form {
			display: flex;
			flex-direction: column;
			max-width: 600px;
			margin: auto;
			margin-top: 20px;
			justify-content: space-evenly;
			height: 160px;
		}
		.form-content {
			width: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
		}
	</style>
</head>
<body>

	<form action="../backend/upload.php" method="post" enctype="multipart/form-data">
		<textarea placeholder="what is on your mind?" name="contentToUpload"></textarea>
		<div class="form-content">
	    	Select image to upload: &nbsp
	    	<input type="file" name="fileToUpload" id="fileToUpload">
	    	Permisson: &nbsp
	    	<select name="permission_type">
	    		<option value="0">view only</option>
	    		<option value="1">Comment</option>
	    		<option value="2">Add</option>
	    	</select>
    		<input type="hidden" name="event_id" value=<?php echo $_GET['event_id']?>>
    	</div>
    	<input type="submit" value="Upload Image" name="submit">
	</form>

</body>
</html>