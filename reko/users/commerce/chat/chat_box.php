<?php include("../control.php"); ?>
<div class="dashboard_content">
        <div class="chatBoxContainer">
            <div class="chatBoxInfo">
                <h2>Dine samtaler</h2>
                <p>Til venstre har du en oversikt over alle dine pågående samtaler, klikk på navnet til kunden eller leverandøren, for å  fortsette samtalen.
                    Til høyre ser du en oversikt over alle Leverandører og Kunder som er registrert i din REKO-ring, klikke på en av dem for å starte en ny samtale.
                </p>
            </div>
            <div class="chat">

                <div class="messages">
                    <div class="msgcontainer">

                        <div class="msgName">Fornavn Etternavn</div>

                    <div class="msg msg-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic laborum iure error officia ipsum autem unde tempora repellendus, dolorem quam, sed quas beatae! Blanditiis odit ducimus veritatis culpa est esse.</div>

                    </div>
                    <div class="msgcontainer">

                        <div class="msgName">Fornavn Etternavn</div>
                        
                    <div class="msg msg-right">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Totam amet eaque ipsum voluptatem quia? Voluptatum laborum ipsam nobis, delectus est odit explicabo! Ducimus aliquam alias illum est nam ab repudiandae?</div>

                    </div>
                
                    <div class="msg msg-left">left</div>
                    <div class="msg msg-right">right</div>
                    <div class="msg msg-left">left</div>
                    <div class="msg msg-right">right</div>
                    <div class="msg msg-left">left</div>
                    <div class="msg msg-right">right</div>
                    <div class="msg msg-left">left</div>
                    <div class="msg msg-left">left</div>
                    <div class="msg msg-right">right</div>
                    
                    
                </div>
                <div class="inputMsg">
                <form class="msgForm" method="POST">
                    <input type="text" id="newMsg" name="newMsg"/>
                    <input type="submit" id="sendMsg" name="sendMsg"/>
                </form>  
                </div>  
            </div>
            
            <!--  --> 



                    <?php /*
                        $chatID = $_GET["chatID"];
                        $sql ="SELECT users.userID, users.firstName,users.lastName, chat_message.message, chat_message.date
                        FROM users
                        INNER JOIN chat_message
                        ON chat_message.msg_from = users.userID
                        WHERE chatID = $chatID;";

                        $result = mysqli_query($db,$sql) or die("kan ikke hente meldinger");
                        $rows = mysqli_num_rows($result);

                        for($k=1; $k<=$rows; $k++){
                            $row = mysqli_fetch_array(result);

                            $userUserID = $row['userID'];
                            $firstName = $row['firstName'];
                            $lastName = $row['lastName'];
                            $message = $row['message'];
                            $date = $row['date'];
                            
                            if($userUserID == $userID){
                                $class = "msg-right";
                            }
                            else{
                                $class = "msg-left";
                            }

                            print("<div class='msg $class'>");
                            print("<div class='msgName'>");
                            print("</div>")
                            
                            print("</div>");

                        }

                        
                        */?>