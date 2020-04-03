<?php include("../control.php"); ?>

    <div class="dashboard_content">
        <div class="chatContainer">
            <div class="chatInfo">
                <h2>Dine samtaler</h2>
                <p> Til venstre har du en oversikt over alle dine pågående samtaler, klikk på navnet til kunden eller leverandøren, for å  fortsette samtalen.
                    Til høyre ser du en oversikt over alle Leverandører og Kunder som er registrert i din REKO-ring, klikke på en av dem for å starte en ny samtale.
                </p>
            </div>
            <div class="activeChat">
                <table class="chatOverview">
                <tr>
                    <th>Navn</th>
                    <th>Type</th>
                    <th>Status</th> 
                </tr>
                <?php 
                $sql= "SELECT * FROM chat_connection WHERE commerceID = $userID OR customerID = $userID;";
                $result = mysqli_query($db,$sql) or ("Kan ikke hente samtaler akkurat nå.");
                $num = mysqli_num_rows($result);

                for($i=1; $i<=$num; $i++){
                    $part=mysqli_fetch_array($result);

                    $chatID = $part['chatID'];
                    $customerID = $part['customerID'];
                    $commerceID = $part['commerceID'];

                        switch ($userID){
                            case $customerID:
                                $chatPerson = $commerceID;
                            break;
                            case $commerceID:
                                $chatPerson = $customerID;
                            break;
                        }
                    
                    $findPerson ="SELECT * FROM users where userID = $chatPerson;";
                    $chatPersonInfo = mysqli_query($db,$findPerson) or ("kan ikke vise dine samtaler for øyeblikket.");
                    $info = mysqli_fetch_array($chatPersonInfo);
                        $firstName = $info["firstName"];
                        $lastName = $info["lastName"];
                        $type = $info["role"];
                        $time = strtotime($info["last_timestamp"]);
                        

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
                        if (time() - $time > 15 * 60 || date("Y-m-d", $time) != date("Y-m-d") )  {
                             $online = "Frakoblet";
                             $color="red";
                        }
                        else{
                            $online = "Pålogget";
                            $color = "green";
                        }

                    
                    print("<tr><td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$chatID'>$firstName $lastName</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$chatID'>$type</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$chatID' style='color:$color;'>$online</a></td></tr>");
                }
                ?>
                </table>
            </div>
            <div class="newChat">
            <table class="chatOverview">
                <tr>
                    <th>Navn</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
                <?php 
                $sql= "SELECT userID,firstName,lastName, role, last_timestamp FROM users WHERE role='commerce' OR role = 'moderator' ORDER BY role DESC,lastName;";

                $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
                $num = mysqli_num_rows($result);
                
                for($i=1; $i<=$num; $i++){
                    $part=mysqli_fetch_array($result);

                    $firstName = $part["firstName"];
                    $lastName = $part["lastName"];
                    $type = $part["role"];
                    $time = strtotime($part["last_timestamp"]);
                    $usersUserID = $part["userID"];

                        $checkChatID= "SELECT * FROM chat_connection WHERE commerceID = $userID OR customerID = $userID;";
                        $check = mysqli_query($db,$checkChatID) or die ("kan ikke validere");
                        $rowsy = mysqli_fetch_array($check);

                            $commerceID1 = $rowsy["commerceID"];
                            $customerID1 = $rowsy["customerID"];

                            if ($usersUserID != $customerID && $usersUserID != $commerceID){

                                switch ($type){
                                    case "commerce":
                                        $type = "Leverandør";
                                    break;
                                    case "customer":
                                        $type = "Kunde";
                                    break;
                                    case "moderator":
                                        $type = "Moderator";
                                    break;

                                }
                                if (time() - $time > 15 * 60 || date("Y-m-d", $time) != date("Y-m-d") )  {
                                    $online = "Frakoblet";
                                    $color="red";
                                }
                                else{
                                    $online = "Pålogget";
                                    $color = "green";
                                }
                     print("<tr><td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_overview.php?newChat=1&with=$usersUserID'>$firstName $lastName</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_overview.php?newChat=1&with=$usersUserID'>$type</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_overview.php?newChat=1&with=$usersUserID' style='color:$color;'>$online</a></td> </tr>");
                }
            }
                ?>
                </table>


            </div>
            <?php
            if(isset($_GET["newChat"])){
                if($_GET["newChat"] == 1){
                    $newUserChat = $_GET["with"];

                    $newChat = "INSERT INTO chat_connection (commerceID,customerID) VALUES ($newUserChat,$userID);";
                    if(mysqli_query($db,$newChat)){
                        $newChatID_query= "SELECT chatID FROM chat_connection WHERE commerceID  = $newUserChat AND customerID = $userID;";
                        $newChatID = mysqli_query($db,$newChatID_query) or die ("kan ikke opprette forbindelse");
                        mysqli_fetch_array($newChatID);
                        echo "<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$chatID'>";
                    }
                    else{
                        print("kan ikke opprette forbindelse1.");
                    }

                }
            }
            
            
            ?>

        </div>
    </div>
