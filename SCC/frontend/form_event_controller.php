<?php
require "../backend/connection.php";
require "../backend/events/event_details.php";
require "../frontend/navbar.php";?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Set Resources</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <meta name="theme-color" content="#fafafa">

  <style type="text/css">
  	h2{
  		text-align: center;
  	}
    div.container{
    	margin: auto;
    	width: 50%;
    }
    table{
    	text-align: left;
    }
    .right {
      position: absolute;
      right: 0px;
      padding: 10px;
    }
</style>
</head>

<body>
  <h2 >Set reources</h2>

  <?php if (!empty($event_id) && $event_id) {?>
  	<div class="container">

	  	<form action="../backend/events/update_event.php" method="post" name="finalize_event_form" id="finalize_event_form" accept-charset="utf-8">

            <?php
echo "<input type='hidden' name='event_id' value='$event_id'>
                                    <input type='hidden' name='location_id' value='$event_location_id'>
                                    <input type='hidden' name='payment_id' value='$event_payment_id'>
                                    <input type='hidden' name='resource_id' value='$event_resource_id'>";

    echo "<div style='padding-top:30px;'><fieldset><legend>Resources</legend><table cellpadding='10' style='text-align: left;'><tbody>";
    foreach ($event_resources as $label => $value) {
        $column_name = $event_resources_ids[$label];
        echo "<tr><td><label>$label</label></td><td><input type='text' name='$column_name' title='$column_name' value='$value'></td></tr>";
    }
    echo "</tbody></table></fieldset>";

    echo "<div style='padding-top:30px;'>
                    <table cellpadding='10' style='text-align: left;'>
                        <tbody>
                        <tr>
                        <td><button id='finalize_event' type='submit'>Set Resources</button>";
    ?>
        </form>
    </div>


  <?php }?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(document).ready(function () {

		$( "#finalize_event_form" ).submit(function( event ) {
			event_data = $("#finalize_event_form").serializeArray();

		    $.ajax({
              url: "../backend/events/update_event.php",
              cache: false,
              type: "POST",
              dataType: "html",
              data: event_data
            })
            .done(function( data ) {
             	if(data === "updated") {
             		alert("Resources has been set");
             		window.location.href='event_manager_page.php';
             	}
                else alert(data);
            })
            .fail(function() {
                alert("event did not update");
            }); //ajax call

            event.preventDefault();
        });

	});//end document.ready
  </script>
</body>

</html>