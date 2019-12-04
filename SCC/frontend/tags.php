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
	$sql = "SELECT meta_data AS 'tags' FROM groups WHERE group_id = $group_id";
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

if(count($tags) == 1 && $tags[0] == " ")
	exit();

$tagCount = 0;
?>

<html>
<head>
<script>
	function removeTag(name)
	{
		var tagString = "";
		document.querySelectorAll(".remove-tag-btn").forEach( (tag) => {
			if(tag.name != name)
				tagString += tag.value +";";
		});
		
		tagString = tagString.substring(0, tagString.length - 1);
		
		console.log(tagString);
		window.location.replace("../backend/tag_add.php?tag="+tagString+"&<?php echo $params?>");

	}
	
	function addTag()
	{
		var tagString = "";
		document.querySelectorAll(".remove-tag-btn").forEach( (tag) => {
				tagString += tag.value +";";
		});
		
		tagString += document.querySelector("#new-tag").value;
		console.log(tagString);
		window.location.replace("../backend/tag_add.php?tag="+tagString+"&<?php echo $params?>");
		
	}
	
</script>
</head>
<body>
<?php
foreach($tags as $tag) {
	echo "<button onclick='removeTag(this.name)' class='remove-tag-btn' name='".$tagCount++."' value='$tag'> $tag </button>";
}

?>

<input type="text" id="new-tag"/><br>
<button onclick='addTag()'>Add Tag</button>
</body>
</html>
