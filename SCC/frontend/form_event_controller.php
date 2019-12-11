<?php
/*
Author: Siamak Samie
ID: 27502303

This page allows the controller to update resource information for a specific event

*/


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


</head>

<body>
  <div class="container text-center pt-5">

    <?php if (!empty($event_id) && $event_id) {?>
    	<div class="flex border border-primary rounded-top mb-4">

  	  	<form action="../backend/update_resource.php" method="post" name="update_event_resource" id="update_event_resource" accept-charset="utf-8">

              <?php
      echo "<input type='hidden' name='resource_id' value='$event_resource_id'>";

      echo "<fieldset><legend class='bg-primary p-4 mb-4 text-white rounded-top'>Set Resources</legend><table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'><tbody>";
      foreach ($event_resources as $label => $value) {
          $column_name = $event_resources_ids[$label];
          echo "<tr><td><label>$label</label></td><td><input type='text' class='form-control' name='$column_name' title='$column_name' value='$value'></td></tr>";
      }
      echo "</tbody></table></fieldset>";

      echo "<table class='d-flex justify-content-center' cellpadding='20' style='text-align: left;'>
              <tbody>
                <tr>
                  <td><button  class='btn btn-primary' type='submit'>Set Resources</button>
                  </td>
                </tr>
              </tbody>
              </table>";
      ?>
          </form>
      </div>
    <?php }?>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(document).ready(function () {

		$( "#update_event_resource" ).submit(function( event ) {
      event.preventDefault();
			event_data = $("#update_event_resource").serializeArray();

		    $.ajax({
              url: "../backend/update_resource.php",
              cache: false,
              type: "POST",
              dataType: "html",
              data: event_data
            })
            .done(function( data ) {
             	if(data === "updated") {
             		alert("Resource has been set");
             		window.location.href='../frontend/controller_dashboard.php';
             	}
                else alert(data);
            })
            .fail(function() {
                alert("event did not update");
            }); //ajax call
    });

	});//end document.ready
  </script>
</body>

</html>