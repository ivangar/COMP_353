<?php 
require("../backend/connection.php");
require '../backend/events/event_details.php';?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Event details</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <meta name="theme-color" content="#fafafa">

  <style type="text/css">
  	h3{ 
  		text-align: center; 
  	}
    div.container{
    	margin: auto; 
    	width: 50%;
    }
    table{
    	text-align: left;
    }
</style>
</head>

<body>

  <a href='event_manager_page.php'>Go Back</a>
  <h3 >Event Details</h3>

  <?php if(!empty($event_id) && $event_id) {  ?>
  	<div class="container">

	  	<form action="" method="post" name="update_event_form" id="update_event_form" accept-charset="utf-8">
	  			<?php 
	  			 echo "<input type='hidden' name='event_id' value='$event_id'>";

	  			 if(!empty($event_info) && sizeof($event_info) != 0) {
	  				echo "<fieldset><legend>Main details</legend>";
	  				foreach($event_info as $label => $value) { 
	  							$column_name = $event_info_ids[$label];
                  $input_type = "text";

                  //Check date types
                  $d = DateTime::createFromFormat('Y-m-d', $value);
                  if($d && $d->format('Y-m-d') === $value)
                    $input_type = "date";

	  							echo "<p><label>$label</label><input type='$input_type' name='$column_name' title='$column_name' value='$value' required></p>"; 
	  				}
	  				echo "<p><button id='update_event' type='submit'>Update</button><button>Import users</button></p></fieldset>"; 
	  			}
	  						
	  			?>

		</form>

	</div>


  <?php }?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(document).ready(function () {

		$( "#update_event_form" ).submit(function( event ) {
			event_data = $("#update_event_form").serializeArray();
		    
		    $.ajax({
              url: "update_event.php",
              cache: false,
              type: "POST",
              dataType: "html",
              data: event_data
            }) 
            .done(function( data ) {
             	if(data === "updated") alert("event has been updated");
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