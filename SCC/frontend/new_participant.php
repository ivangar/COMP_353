<?php 
session_start();
$event_id = $_GET["event_id"];
$group_id = $_GET["group_id"];
$participant_data = array();
require("navbar.php");
?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>New participant</title>
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
    .right {
      position: absolute;
      right: 0px;
      padding: 10px;
    }
</style>
</head>

<body>

  <?php if(isset($_SESSION['participant_data']) && !empty($_SESSION['participant_data'])){
          $participant_data = $_SESSION['participant_data'];
          unset($_SESSION['participant_data']);
        } 
  ?>
  <h3>Add a new participant to your event</h3>

  	<div class="container">
      <div style='padding: 30px 0;'>
          <table cellpadding='10' style='text-align: left;'>
            <tbody>
              <tr>
              <td>Please type the user id of the person <br>you want to add to your event </td>
              <td><input type='text' name='search_user_id' id='search_user_id'> </td>
              <td><button id='search_user'>Search User</button></td>
              </tr>
            </tbody>
          </table>
      </div>

	  	<form action="../backend/users/update_participant.php" method="post" name="add_participant_form" id="add_participant_form" accept-charset="utf-8">
      <fieldset>
        <table cellpadding="10" style="text-align: left;">
          <tbody>
            <tr>
              <td><label>First Name</label></td>
              <td><input type="text" name="first_name" title="first_name" disabled <?php if(!empty($participant_data['First Name'])) echo "value='" . $participant_data['First Name'] . "'"; ?> ></td>
            </tr>
            <tr>
              <td><label>Last Name</label></td>
              <td><input type="text" name="last_name" title="last_name" disabled <?php if(!empty($participant_data['Last Name'])) echo "value='" . $participant_data['Last Name'] . "'"; ?>></td>
            </tr>
            <tr>
              <td><label>Middle Name</label></td>
              <td><input type="text" name="middle_name" title="middle_name" disabled <?php if(!empty($participant_data['Middle Name'])) echo "value='" . $participant_data['Middle Name'] . "'"; ?>></td>
            </tr>
            <tr>
              <td><label>Address</label></td><td>
              <input type="text" name="address" title="address" disabled <?php if(!empty($participant_data['Address'])) echo "value='" . $participant_data['Address'] . "'"; ?>></td>
            </tr>
            <tr>
              <td><label>Date of birth</label></td>
              <td><input type="date" name="date_of_birth" title="date_of_birth" disabled <?php if(!empty($participant_data['Date of birth'])) echo "value='" . $participant_data['Date of birth'] . "'"; ?>></td>
            </tr>
            <tr>
              <td><label>Email</label></td>
              <td><input type="text" name="email" title="email" disabled <?php if(!empty($participant_data['Email'])) echo "value='" . $participant_data['Email'] . "'"; ?>></td>
            </tr>
            <tr>
              <td><label>Organization</label></td>
              <td><input type="text" name="organization" title="organization" disabled <?php if(!empty($participant_data['Organization'])) echo "value='" . $participant_data['Organization'] . "'"; ?>></td>
            </tr>
          </tbody>
        </table>
      </fieldset>

      <?php if(!empty($participant_data)){ ?>
     <div style='padding-top:30px;'>
            <table cellpadding='10' style='text-align: left;'>
              <tbody>
                <tr>
                <td><button id='update_event' type='submit'>Add Participant</button></td>
                </tr>
              </tbody>
            </table>
      </div>
      <?php }?>
		</form>
	</div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(document).ready(function () {
    var group_id = <?php echo "$group_id"; ?>;
    var event_id = <?php echo "$event_id"; ?>;

		$( "#add_participant_form" ).submit(function( event ) {
        
        event.preventDefault();
			  var user_id = <?php if(!empty($participant_data)) { $user_id = $participant_data['user_id']; echo "$user_id"; } else echo 0; ?>        
        event_participant = { "action": "add_participant", "user_id": user_id, "group_id": group_id};

        $.ajax({
              url: "../backend/users/update_participant.php",
              cache: false,
              type: "POST",
              dataType: "html",
              data: event_participant
            }) 
            .done(function( data ) {
              if(data === "success"){
                alert("participant has been added to the event");
                window.location.href = "event_details_page.php?event_id="+event_id;
              } 
                else alert(data);
            })
            .fail(function() {
                alert("participant's info did not update"); 
            }); //ajax call

    });

    $("#search_user").click(function (event) {
        event.preventDefault();
        var search_user_id = $("#search_user_id").val();     
        
        search_data = { "user_id": search_user_id, "group_id": group_id};

        $.ajax({
          url: "../backend/users/search_user.php",
          cache: false,
          type: "POST",
          dataType: "html",
          data: search_data
        }) 
        .done(function( data ) {
            if(data !== ""){ alert(data); }
            else { window.location.reload(true); }
        })
        .fail(function() {
            alert("user not found"); 
        }); //ajax call

    });
      
	});//end document.ready
  </script>
</body>

</html>