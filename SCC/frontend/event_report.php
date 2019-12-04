<?php
require("../backend/get_event_report_info.php");
echo "Event Stats";


echo "ID: " . $event_id . "<br>";
echo "Name: " . $event_name. "<br>";
echo "Cost" .$event_cost. "<br>";
echo "Start Date".$event_start. "<br>";
echo "End Date".$event_end. "<br>";
echo "primary group id" . $event_primary_group_id. "<br>";


include("group_report.php");


?>


<head>
	<script>
	function searchGroups()
	{
		var frame = document.getElementById("searchView");
		var search = document.getElementById("searchTerms").value;
		frame.src = "../backend/group_search.php?event=<?php echo $event_id?>&primary=<?php echo $event_primary_group_id ?>&search="+search;
	}

	</script>
</head>

<input id="searchTerms" type="text" placeholder="search groups" />
<button onclick="searchGroups()">Search</button>
<br>
<iframe id="searchView" frameborder="0" width="800" height="500" src="../backend/group_search.php?event=<?php echo $event_id?>&primary=<?php echo $event_primary_group_id ?>"></iframe>
