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

                    
                    print("<tr><td><a href='http://opheimpi.zapto.org/www/sda/reko/users/commerce/chat/chat_box.php?chatID=$chatID'>$firstName $lastName</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/commerce/chat/chat_box.php?chatID=$chatID'>$type</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/commerce/chat/chat_box.php?chatID=$chatID' style='color:$color;'>$online</a></td></tr>");
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
                $sql= "SELECT firstName,lastName, role, last_timestamp FROM users WHERE role='commerce' OR role = 'moderator' ORDER BY role DESC,lastName;";

                $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
                $num = mysqli_num_rows($result);

                for($i=1; $i<=$num; $i++){
                    $part=mysqli_fetch_array($result);

                    $firstName = $part["firstName"];
                    $lastName = $part["lastName"];
                    $type = $part["role"];
                    $time = strtotime($part["last_timestamp"]);
                    
                

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
                    print("<tr><td><a href='http://opheimpi.zapto.org/www/sda/reko/users/commerce/chat/chat_box.php?chatID=$chatID'>$firstName $lastName</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/commerce/chat/chat_box.php?chatID=$chatID'>$type</a></td> <td><a href='http://opheimpi.zapto.org/www/sda/reko/users/commerce/chat/chat_box.php?chatID=$chatID' style='color:$color;'>$online</a></td> </tr>");
                }
                ?>
                </table>


            </div>
        </div>
    </div>
