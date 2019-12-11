<?php
/*
Author: Ivan Garzon
ID: 27006284
This script displays a form with all the event information. Each section is related to the different table that has a 
relationship with the Foreign Keys of the event. If a user who is not the event manager of the corresponging event 
is viewing this page, then he can only view the data in disabled fields and the participants.
If the event manager is viewing the event, the form displays all the action buttons related to the event.
*/ 
require("../backend/connection.php");
require("../backend/events/event_details.php");
require("navbar.php");?>

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
</head>

<body>

<div class="container text-center pt-5">
  
  <h3 class="pt-1 pb-5">Event Details</h3>
  
  <?php if(!empty($event_id) && $event_id) { ?>
  	<div class="flex border border-primary rounded-top mb-4">
      
      <form action="../backend/events/update_event.php" class="form" method="post" name="update_event_form" id="update_event_form" accept-charset="utf-8">
      
      <?php 
           $disabled = (!$event_manager) ? "disabled='disabled'" : "";
	  			 echo "<input type='hidden' name='event_id' value='$event_id'>
           <input type='hidden' name='location_id' value='$event_location_id'>
           <input type='hidden' name='payment_id' value='$event_payment_id'>
           <input type='hidden' name='resource_id' value='$event_resource_id'>";
           
	  			 if(!empty($event_info) && sizeof($event_info) != 0) {
             echo "<fieldset $disabled><legend class='bg-primary p-4 mb-4 text-white rounded-top'>Main details</legend><table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'><tbody>";
             foreach($event_info as $label => $value) { 
               $column_name = $event_info_ids[$label];
               $input_type = "text";
               
               if($column_name === "type"){
                    $options = ($value === "private") ? "<option value='private' selected>private</option><option value='non-profit'>non-profit</option>" : "<option value='private'>private</option><option value='non-profit' selected>non-profit</option>";
                    echo "<tr><td><label>$label</label></td><td><select class='form-control' name='event_types'>$options</select></td></tr>";
                  }
                    
                  elseif($column_name === "recurrent"){
                    $options = ($value == 1) ? "<option value='1' selected>yes</option><option value='0'>no</option>" : "<option value='1'>yes</option><option value='0' selected>no</option>";
                     echo "<tr><td><label>$label</label></td><td><select class='form-control' name='recurrent_event'>$options</select></td></tr>";
                    }
                    
                    elseif($column_name === "status"){
                      $radio_btns = ($value == 1) ? 
                      "<input type='radio' name='status' title='status' value='1' checked> active <input type='radio' name='status' title='status' value='2' > archived " : 
                                "<input type='radio' name='status' title='status' value='1' > active <input type='radio' name='status' title='status' value='2' checked > archived ";
                                echo "<tr><td><label>$label</label></td><td>$radio_btns</td></tr>";
                              }
                              
                  //Check date types
                  elseif($column_name === "start_date" || $column_name === "end_date" || $column_name === "period"){
                    
                    $input = "<input type='date' class='form-control' name='$column_name' title='$column_name'>";
                    
                    if(!empty($value))
                    $input = "<input type='date' class='form-control' name='$column_name' title='$column_name' value='$value'>";
                    
                    echo "<tr><td><label>$label</label></td><td>$input</td></tr>";
                    
                  }
                  
                  else{
                      echo "<tr><td><label>$label</label></td><td><input class='form-control' type='$input_type' name='$column_name' title='$column_name' value='$value'></td></tr>";
                    }
                    
	  				}
            echo "</tbody></table></fieldset>";
	  			}
          
          if(!empty($event_location) && sizeof($event_location) != 0) {
            echo "<div style='padding-top:30px;'><fieldset $disabled><legend class='bg-primary p-4 mb-4 text-white rounded-top'>Location details</legend><table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'><tbody>";
            foreach($event_location as $label => $value) { 
                  $column_name = $event_location_ids[$label];
                  echo "<tr><td><label>$label</label></td><td><input class='form-control' type='text' name='$column_name' title='$column_name' value='$value'></td></tr>"; 
                }
            echo "</tbody></table></fieldset></div>";
          }
          
          if(!empty($event_payment) && sizeof($event_payment) != 0) {
            echo "<div style='padding-top:30px;'><fieldset $disabled><legend class='bg-primary p-4 mb-4 text-white rounded-top'>Payment details</legend><table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'><tbody>";
            foreach($event_payment as $label => $value) { 
              $column_name = $event_payment_ids[$label];
              echo "<tr><td><label>$label</label></td><td><input class='form-control' type='text' name='$column_name' title='$column_name' value='$value'></td></tr>"; 
            }
            echo "</tbody></table></fieldset></div>";
          }

          if(!empty($event_resources) && sizeof($event_resources) != 0) {
            echo "<div style='padding-top:30px;'><fieldset $disabled><legend class='bg-primary p-4 mb-4 text-white rounded-top'>Resources</legend><table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'><tbody>";
            foreach($event_resources as $label => $value) { 
                  $column_name = $event_resources_ids[$label];
                  echo "<tr><td><label>$label</label></td><td><input type='text' class='form-control' name='$column_name' title='$column_name' value='$value'></td></tr>"; 
            }
            echo "</tbody></table></fieldset></div>";
          }

          if($event_manager){
            echo "<div style='padding-top:30px;'>
            <table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'>
            <tbody>
                      <tr>
                      <td><button class='btn btn-primary'  id='update_event' type='submit'>Update</button></td>
                      <td><button class='btn btn-primary'  id='import_users' >Import users</button></td>
                      <td><button class='btn btn-primary'  id='view_participants'>View participants</button></td>
                      <td><button class='btn btn-primary'  id='new_participant'>Add new participant</button></td>
                      <td><button class='btn btn-primary'  id='event_report'>View Event Report</button></td>
                      </tr>
                      </tbody>
                      </table>
                      </div>";
                    }
                
                    if(!$event_manager){
                      echo "<div style='padding-top:30px;'>
                  <table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'>
                  <tbody>
                  <tr>
                      <td><button class='btn btn-primary' id='view_participants'>View participants</button></td>
                      </tr>
                      </tbody>
                      </table>
                      </div>";
                    }
                    
                    ?>

    </form>

  </div>
</div>


<?php }?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(document).ready(function () {

    var users_imported = <?php if(isset($_SESSION['users_imported']) && $_SESSION['users_imported']) {echo "true"; unset($_SESSION['users_imported']);} else echo "false"; ?>;
    var errors = <?php if(isset($_SESSION['errors'])) {$errors = $_SESSION['errors']; echo "'$errors'"; unset($_SESSION['errors']);} else echo "''"; ?>;
    if(users_imported) alert("users have been imported successfully");
    if (errors !== "") alert(errors);

    var event_id = <?php echo $event_id; ?>;
    var group_id = <?php echo $group_id; ?>;
    var group_manager = <?php echo $event_manager; ?>;

		$( "#update_event_form" ).submit(function( event ) {
      event_data = $("#update_event_form").serializeArray();
		    
        event.preventDefault();

		    $.ajax({
          url: "../backend/events/update_event.php",
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
    });

    $("#import_users").click(function (event) {
      event.preventDefault();
        window.location.href = "import_users.php?event_id="+event_id;
    });

    $("#view_participants").click(function (event) {
        event.preventDefault();
        var event_name = $('#update_event_form').find('input[name="event_name"]').val();
        window.location.href = "view_participants.php?group_id="+group_id+"&group_manager="+group_manager+"&group_name="+event_name;
    });

    $("#new_participant").click(function (event) {
      event.preventDefault();
        window.location.href = "new_participant.php?event_id="+event_id+"&group_id="+group_id;
    });
	
	$("#event_report").click(function (event) {
    event.preventDefault();
        window.location.href = "event_report.php?event_id="+event_id;
    });
      
	});//end document.ready
  </script>
</body>

</html>