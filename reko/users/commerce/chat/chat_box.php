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
                    <div class="msg msg-left">left</div>
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
            