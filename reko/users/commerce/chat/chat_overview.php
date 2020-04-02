<?php include("../control.php"); ?>

    <div class="dashboard_content">
        <div class="chatContainer">
            <div class="chatInfo">
                <h2>Dine samtaler</h2>
                <p>Til venstre har du en oversikt over alle dine pågående samtaler, klikk på navnet til kunden eller leverandøren, for å  fortsette samtalen.
                    Til høyre ser du en oversikt over alle Leverandører og Kunder som er registrert i din REKO-ring, klikke på en av dem for å starte en ny samtale.
                </p>
            </div>
            <div class="activeChat">
                <table class="chatOverview">
                <tr>
                    <th>Navn</th>
                    <th>Type</th>
                    <th>Pålogget</th> 
                </tr>
                <?php 
                $sql= "SELECT chat_connection.chatID, users.firstName,users.lastName, users.role, users.onlineStatus
                FROM users
                INNER JOIN chat_connection
                ON users.userID = chat_connection.commerceID
                WHERE chat_connection.customerID = $userID";

                $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
                $num = mysqli_num_rows($result);

                for($i=1; $i<=$num; $i++){
                    $part=mysqli_fetch_array($result);

                    $firstName = $part["firstName"];
                    $lastName = $part["lastName"];
                    $type = $part["role"];
                    $online = $part["onlineStatus"];
                    $chatID = $part['chatID'];
                    

                    switch ($type){
                        case "commerce":
                            $type = "Leverandør";
                        break;
                        case "customer":
                            $type = "Kunde";
                        break;
                        case "Moderator":
                            $type = "Moderator";
                        break;

                    }
                    print("<tr><td><a href='/chat_box.php?chatID=$chatID'>$firstName $lastName</a></td> <td><a href='/chat_box.php?chatID=$chatID'>$type</a></td> <td><a href='/chat_box.php?chatID=$chatID'>$online</a></td></tr>");
                }
                ?>
                </table>
            </div>
            <div class="newChat">
            <table class="chatOverview">
                <tr>
                    <th>Navn</th>
                    <th>Type</th>
                </tr>
                <?php 
                $sql= "SELECT firstName,lastName, role FROM users;";

                $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
                $num = mysqli_num_rows($result);

                for($i=1; $i<=$num; $i++){
                    $part=mysqli_fetch_array($result);

                    $firstName = $part["firstName"];
                    $lastName = $part["lastName"];
                    $type = $part["role"];
                    
                    

                    switch ($type){
                        case "commerce":
                            $type = "Leverandør";
                        break;
                        case "customer":
                            $type = "Kunde";
                        break;
                        case "Moderator":
                            $type = "Moderator";
                        break;

                    }
                    print("<tr><td><a href='/chat_box.php?chatID=$chatID'>$firstName $lastName</a></td> <td><tr><td><a href='/chat_box.php?chatID=$chatID'>$type</a></td>¨</tr>");
                }
                ?>
                </table>


            </div>
        </div>
    </div>
