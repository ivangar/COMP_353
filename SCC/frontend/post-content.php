<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	<div class="container border border-primary p-0 rounded-top mb-5">
			<header class="page-header bg-primary p-4 text-white">
                <div class="container-fluid ">
                    <h2>Post to Wall</h2>
                </div>
            </header>
		<form class="form p-4" action="../backend/upload.php" method="post" enctype="multipart/form-data">
		<div class="form-content">
			<label class="pt-4">Write a post</label>
			<textarea class="form-control" placeholder="what is on your mind?" name="contentToUpload"></textarea>
			<label class="pt-4">Upload image</label>
			<div class="custom-file">
				<input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
				<label class="custom-file-label" for="fileToUpload">Select image to upload</label>
			</div>
	    	<label class="pt-4">Set Permission</label>
	    	<select name="permission_type" class="custom-select custom-select-lg mb-3">
				<option value="0">view only</option>
	    		<option value="1">Comment</option>
	    		<option value="2">Add</option>
			</select>



    		<input type="hidden" name="event_id" value=<?php if (isset($_GET['event_id'])) {
    echo $_GET['event_id'];
}
?>>
    		<input type="hidden" name="group_id" value=<?php if (isset($_GET['group_id'])) {
    echo $_GET['group_id'];
}
?>>
    	</div>
    	<input type="submit" class="btn btn-primary mt-3" value="Post" name="submit">
	</form>
</div>

</html>