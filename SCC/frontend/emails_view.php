<body>
        <script>
            function alertFunction(sender, subject, date, emailContent)
            {
                alert("From: " + sender + '\nSubject: ' + subject + "\n" + emailContent + "\n\n\nSent on: " + date);
            }
        </script>
        <?php
            include("navbar.php");
            include ("../backend/emails.php");
            $emails = getEmails();

            echo
                "
                <h2>Email Page</h2>
                <hr />
                <h4>Inbox</h4>
                ";
            if($emails->num_rows == 0)
            {
                echo "Inbox is empty";
            }
            else
            {
                echo "<table width='600' border='1'><tr><th>Sender</th><th>Subject</th><th>Date</th><th>See email</th></tr>";

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

                    echo '<td><input type="button" onclick=\'alertFunction(';
                    echo "\"".$email["sender_email"];
                    echo "\",\"";
                    echo $email["title"];
                    echo "\",\"";
                    echo $email["date"];
                    echo "\",\"";
                    echo $email["body"]."\"";
                    echo ')\' value=\'Show Email\' /></td></tr>';
                }

                echo "</table>";
            }



        echo
        "
            <br />
            <h4>Send an Email</h4>
            <hr />
            <table width='600' >
            <form action='../backend/send_email.php' method='post' enctype='multipart/form-data'>
            <tr>
            <td width='20%'>To: <input type='text' name='email_receiver' id='email_receiver'/></td>
            </tr>
            <tr>
            <td width='20%'>Subject: <input type='text' name='email_title' id='email_title'/></td>
            </tr>
            <tr>
            <td width='20%'>Enter email contents here <br /><textarea name='email_body' id='email_body' rows='5' cols='30' ></textarea></td>
            </tr>
        
            <tr>
            <td><input type='submit' name='submit' /></td>
            </tr>
        
            </form>
            </table>";
        ?>
    </body>

</html>