<?php 

if(!isset($_GET["type"]))
	exit();

include ("../backend/connection.php");


$type = $_GET["type"];

if($type == "group")
{
	if(!isset($_GET["group"]))
		exit();
	
	$group_id = $_GET["group"];
	$sql = "SELECT meta_data AS 'tags' FROM `groups` WHERE group_id = $group_id";
	$params = "type=group&group=".$group_id;

}
else if ($type == "user")
{
	if(!isset($_GET["user"]))
		exit();
	
	$user_id = $_GET["user"];
	$sql = "SELECT meta_data AS 'tags' FROM users where user_id = $user_id";
	$params = "type=user&user=".$user_id;

}
$tag_data = $conn->query($sql)->fetch_assoc();

$tags = explode(";", $tag_data["tags"]);


$tagCount = 0;
?>
<head>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>


<script>
	function removeTag(name)
	{
		var tagString = "";
		document.querySelectorAll(".remove-tag-btn").forEach( (tag) => {
			if(tag.name != name)
				tagString += tag.value +";";
		});
		
		tagString = tagString.substring(0, tagString.length - 1);		
		window.location.replace("../backend/tag_add.php?tag="+tagString+"&<?php echo $params?>");

	}
	
	function addTag()
	{
		var tagString = "";
		document.querySelectorAll(".remove-tag-btn").forEach( (tag) => {
				tagString += tag.value +";";
		});
		
		tagString += document.querySelector("#new-tag").value;
		window.location.replace("../backend/tag_add.php?tag="+tagString+"&<?php echo $params?>");
		
	}
	
</script>
<?php
foreach($tags as $tag) {
	if($tag != "")
		echo "<button onclick='removeTag(this.name)' class='remove-tag-btn btn btn-secondary' name='".$tagCount++."' value='$tag'> $tag </button>";
}

?>
<br/>
<input type="text" id="new-tag"/>
<button class='btn btn-primary' onclick='addTag()'>Add Tag</button>
</body>
