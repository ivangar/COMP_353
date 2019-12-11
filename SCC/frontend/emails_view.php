<?php
/*
Author: Nicolas brodeur-champagne
ID: 27043651
This is the email client for the site.
*/


    include("navbar.php");
    include ("../backend/emails.php");
?>


<html>
<head>
</head>
<body>
        <script>
            function alertFunction(sender, subject, date, emailContent)
            {
                alert("From: " + sender + '\nSubject: ' + subject + "\n" + emailContent + "\n\n\nSent on: " + date);
            }
        </script>
        <?php
            $emails = getEmails();

            echo
                "
                <div class='container-fluid'>
                <br />
                <h4>Inbox</h4>
                <hr />
                ";
            if($emails->num_rows == 0)
            {
                echo "Inbox is empty";
            }
            else
            {
                echo "<div class='container'> <table class='table table-striped' width='500' ><thead><tr><th>Sender</th><th>Subject</th><th>Date</th><th>See email</th></tr></thead>";

                for ($x = 0; $x < $emails->num_rows; $x++)
                {
                    $email = $emails->fetch_assoc();

                    echo "<tr><td>";
                    echo $email["sender_email"];
                    echo "</td>";

                    echo "<td>";
                    echo $email["title"];
                    echo "</td>";

                    echo "<td>";
                    echo $email["date"];
                    echo "</td>";

                    echo '<td><a href="#modal'
                        . $email["email_id"]
                        .'" data-toggle="modal" title="Show Email" class="btn btn-primary">
                               Show Email
                            </a>
                          </td>
                        </tr>';

                    echo '<!-- Modal -->
                  <div class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal'
                        .$email["email_id"]
                    . '" style="display: none;">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Email</h5>
                                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>        
                              </div>
                              <div class="modal-body">
                                  <div class="col-lg-10">
                                      <p>From: '
                                        . $email['sender_email']
                                        .'</p>
                                  </div>
                                  <div class="col-lg-10">
                                      <p>Date: '
                                        . $email['date']
                                        .'</p>
                                  </div>
                                  <div class="col-lg-10">
                                      <p>Subject: '
                                        . $email['title']
                                        .'</p>
                                  </div>
                                  <div class="col-lg-10">
                                      <p>Email: '
                                        . $email['body']
                                        .'</p>
                                  </div>
                               </div>
                          </div>
                      </div>
                  </div>';
                }

                echo "</table></div>";
            }



        echo
        "
            <br />
            <h4>Send an Email</h4> 
            <a href='#myModal' data-toggle='modal'  title='Compose'    class='btn btn-primary'>
               Compose
            </a>
            <hr />";

             echo '
                  <!-- Modal -->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Compose</h5>
                                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>        
                              </div>
                              <div class="modal-body">
                                  <form action=\'../backend/send_email.php\' method=\'post\' enctype=\'multipart/form-data\' role="form" class="form-horizontal">
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">To</label>
                                          <div class="col-lg-10">
                                              <input type="text" placeholder="" name=\'email_receiver\' id=\'email_receiver\' class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Subject</label>
                                          <div class="col-lg-10">
                                              <input type="text" placeholder="" name=\'email_title\' id=\'email_title\' class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Message</label>
                                          <div class="col-lg-10">
                                              <textarea rows="10" cols="30" class="form-control" name=\'email_body\' id=\'email_body\'></textarea>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                              <button class="btn btn-primary" type="submit">Send</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
           </div>';
        ?>
    </body>

</html>