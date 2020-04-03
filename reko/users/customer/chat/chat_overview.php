<?php include("../control.php"); ?>

    <div class="dashboard_content">
        <div class="chatContainer">
            <div class="chatInfo">
                <h2>Send melding</h2>
                <p> Til venstre har du en oversikt over alle dine pågående samtaler, klikk på navnet til kunden eller leverandøren, for å  fortsette samtalen.
                    Til høyre ser du en oversikt over alle Leverandører og Kunder som er registrert i din REKO-ring, klikke på en av dem for å starte en ny samtale.
                </p>
            </div>
            <div class="activeChat">
            <h3>Dine samtaler</h3>
                <table class="chatOverview">
                <tr>
                    <th>Navn</th>
                    <th>Type</th>
                    <th>Status</th> 
                    <th>Siste melding</th>
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

                    $lastMessage_query = "SELECT message 
                                          FROM chat_message 
                                          WHERE chatID = $chatID 
                                          AND date=(
                                              SELECT MAX(date) 
                                              FROM chat_message 
                                              WHERE chatID = $chatID);";
                    $lastMessage_query_res = mysqli_query($db,$lastMessage_query) or ("kan ikke hente siste melding");
                    $l = mysqli_fetch_array($lastMessage_query_res);
                    $lastMessage1 = base64_decode($l['message']);
                    $lastMessage = strlen($lastMessage1) > 20 ? substr($lastMessage1,0,20)."..." : $lastMessage1;

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

                    
                    print("<tr><td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$chatID'>$firstName $lastName</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$chatID'>$type</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$chatID' style='color:$color;'>$online</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$chatID'>$lastMessage</a></td></tr>");
                }
                ?>
                </table>
            </div>
            <div class="newChat">
                <h3>Ny samtale </h3>
            <table class="chatOverview">
                <tr>
                    <th>Navn</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
                <?php 
                $sql= "SELECT userID,firstName,lastName, role, last_timestamp FROM users ORDER BY role DESC,lastName;";

                $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
                $num = mysqli_num_rows($result);
                
                for($i=1; $i<=$num; $i++){
                    $part=mysqli_fetch_array($result);

                    $firstName = $part["firstName"];
                    $lastName = $part["lastName"];
                    $type = $part["role"];
                    $time = strtotime($part["last_timestamp"]);
                    $usersUserID = $part["userID"];

                        $checkChatID= "SELECT * FROM chat_connection WHERE commerceID = $usersUserID OR customerID = $usersUserID;";
                        $check = mysqli_query($db,$checkChatID) or die ("kan ikke validere");
                        $existChat = mysqli_num_rows($check);

                            if ($existChat == 0 && $usersUserID != $userID){
                                

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
                        $newChatID_res = mysqli_query($db,$newChatID_query) or die ("kan ikke opprette forbindelse");
                        $newChatID_array=mysqli_fetch_array($newChatID_res);
                        $newChatID = $newChatID_array["chatID"];
                        
                        echo "<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/customer/chat/chat_box.php?chatID=$newChatID'>";
                    }
                    else{
                        print("kan ikke opprette forbindelse1.");
                    }

                }
            }
            
            
            ?>

        </div>
    </div>
