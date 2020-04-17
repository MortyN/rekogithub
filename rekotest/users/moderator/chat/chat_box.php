<?php include("../control.php"); 
$chatID = $_GET["chatID"];
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<div class="dashboard_content">
    <?php
    $control_query="SELECT * FROM chat_connection WHERE chatID = $chatID;";
    $control_res = mysqli_query($db,$control_query) or die ("Du har ikke tilgang til denne meldingen.");
    $control_array = mysqli_fetch_array($control_res);
    $ID_control1 = $control_array["commerceID"];
    $ID_control2 = $control_array["customerID"];
    if($ID_control1 != $userID && $ID_control2 != $userID){
        print("<h3> #404 - Accsess denied!");
    }
    else{?>
        <div class="chatBoxContainer">
            <div class="chatBoxInfo">
                <h2>Dine samtaler</h2>
                <p>Til venstre har du en oversikt over alle dine pågående samtaler, klikk på navnet til kunden eller leverandøren, for å  fortsette samtalen.
                    Til høyre ser du en oversikt over alle Leverandører og Kunder som er registrert i din REKO-ring, klikke på en av dem for å starte en ny samtale.
                </p>
            </div>
            <div class="chat">

                <div class="messages">
                   
                <?php 
                        
                        $sql ="SELECT users.userID, users.firstName,users.lastName, chat_message.message, chat_message.date
                        FROM users
                        INNER JOIN chat_message
                        ON chat_message.msg_from = users.userID
                        WHERE chatID = $chatID;";

                        $result = mysqli_query($db,$sql) or die("kan ikke hente meldinger");
                        $rows = mysqli_num_rows($result);

                        for($k=1; $k<=$rows; $k++){
                            $row = mysqli_fetch_array($result);

                            $userUserID = $row['userID'];
                            $firstName = $row['firstName'];
                            $lastName = $row['lastName'];
                            $message = base64_decode($row['message']);
                            $date = $row['date'];
                            
                            if($userUserID == $userID){
                                $class = "right";
                            }
                            else{
                                $class = "left";
                            }?>
                            <div class="msgcontainer">

                            <div class="msgName msgName-<?php print($class); ?> "><?php print($firstName." ".$lastName); ?> </div>

                            <div class="msg msg-<?php print($class);?>"> <?php print($message); ?></div>
                            <div class="msgDate msgDate-<?php print($class);?>"> <?php print($date); ?> </div>
                            </div>
                            <?php
                        } ?>
                    
                    
                </div>
                <div class="inputMsg">
                <form class="msgForm" method="POST">
                    <textarea id="newMsg" name="newMsg" autofocus ></textarea>
                    <a id="msgReload" href="http://reko.opheim.as/users/moderator/chat/chat_box.php?chatID=<?php print($chatID);?>"><i class="icon-repeat"></i></a> 
                    <input type="submit" id="sendMsg" name="sendMsg"/>
                    
                </form>  
                </div>  
            </div>
            <script>
    $('.messages').scrollTop($('.messages')[0].scrollHeight);

</script>
            
           <?php
           if(isset($_POST["sendMsg"])){
               $newMessage = base64_encode($_POST["newMsg"]);
               
               $sql_newMsg = "INSERT INTO chat_message (chatID, msg_from, message, date) VALUES ('$chatID','$userID','$newMessage', CONVERT_TZ(NOW(),'+00:00','+4:00'))";
              
               if(mysqli_query($db,$sql_newMsg)){
                echo "<meta http-equiv='refresh' content='0;url=http://reko.opheim.as/users/moderator/chat/chat_box.php?chatID=$chatID'>";
               }
               else{
                   print("Kan ikke sende melding");
                   
                   
               }
            }
        }?>