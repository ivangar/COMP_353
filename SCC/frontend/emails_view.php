<html>
    <head>
        <script>
            function alertFunction(sender, subject, date, emailContent)
            {
            alert("From: " + sender + '\nSubject: ' + subject + "\n" + emailContent + "\n\n\nSent on: " + date);
            }
        </script>
    </head>

    <body>
        <?php
            include ("emails.php");
            $emails = getEmails($_SESSION['active_user']['email']);

            if($emails.count == 0)
            {
                echo "Inbox is empty";
            } 
            else
            {
                echo "<table width='600'><tr><th>Sender</th><th>Subject</th><th>Date</th><th>See email</th></tr>";

                foreach($emails as $email)
                {
                    echo "<tr><td>";
                    echo $email.sender;
                    echo "</td>";

                    echo "<td>";
                    echo $email.title;
                    echo "</td>";

                    echo "<td>";
                    echo $email.date;
                    echo "</td>";

                    echo "<td><input type='button' onclick='alertFunction(";
                    echo $email.sender;
                    echo",";
                    echo $email.title;
                    echo ",";
                    echo $email.date;
                    echo ",";
                    echo $email.body;
                    echo ")' value='Show Email' /></td></tr>";
                }

                echo "</table>";
            }
        ?>
    </body>

</html>