<!DOCTYPE html>
    <head>
    <meta charset="UTF-8">
    <title>REKO - HORTEN</title>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="loginBody">
        
        <div class="logInContainer">
        <a href="../index.php"><img class="login_logo" src="../img/rekologo.png" alt="Reko logo"></a>
            <div class="loginForm">
                <h2> Glemt passord?</h2>
                <form method="POST" action="" name="loginForm">
                    <a>Brukernavn eller E-post:</a><br>
                    <input type="text" name="userName-Email" id="userName-Email" required/><br><br>
                    
                    <input type="submit" value="Tilbakestill" name="resetPassword" /><br>


            


        <?php
        include("login_function/loginFunction.php");
        include("../db/connect.php");
         
        if (isset($_POST["resetPassword"])){
            $userName_Email = $_POST['userName-Email'];
            
            $userExist = emailUsernameExist($userName_Email);
            

            if($userExist){
                include ("../users/mail-config.php");
                $sql01 = "SELECT email FROM users WHERE userName = '$userName_Email' or email = '$userName_Email';";
                $result01 = mysqli_query($db,$sql01) or die ("Kan ikke hente epost");
                $part = mysqli_fetch_array($result01);

                $email = $part["email"];

                $token = bin2hex(random_bytes(30));
                $sql = "UPDATE users SET token = '$token' WHERE userName = '$userName_Email' or email = '$userName_Email';";
                
                $sqlQuery = mysqli_query($db,$sql) or die("Ikke mulig &aring; hente data fra databasen ");

                $resetLink = "http://opheimpi.zapto.org/www/sda/reko/access/resetPSW.php?".$token;
                

                $mail->Subject = $userFirstName." ".$userLastName." har bekreftet orderen din!";
                $mail->Body ="
                <html>
                <body>
                <head>
                <meta charset='UTF-8'/>
                </head>
                <div class='container'>
                <div class='innerContainer'>
                        <a href ='http://opheimpi.zapto.org'><img class='logo'src='http://opheimpi.zapto.org/www/sda/reko/img/rekologo.png'/></a>
                        <hr>
                        <h1>Tilbakestilling av passord</h1>
                        <h2>Trykk på linken under for å tilbakestille ditt passord:</h2>
                        <hr>
                        <a href='$resetLink'>$resetLink</a>
                        <hr>
                        
                        

                        <p class='footerStrong'><strong>Hvis du ikke har bedt om denne mailen, kan du bare se bort i fra denne.<br>
                        Dersom du fortsatt har problemer med å logge in, ber vi deg ta kontakt med en av våres kontaktpersoner.</strong></p><br><br>

                        <p class='footerText'>Denne mailen kan ikke besvares. Ønsker du å ta kontakt,<br>
                        <a href='http://opheimpi.zapto.org/contact.php'>kontakt en av våres kontaktpersoner.</a></p>
                </div>
                </div>
                </body>
            <style>
                body{
                    background-color:lightgrey;
                }
                .container{
                    width:80vw;
                    margin:50px auto;
                    border: 3px solid green;
                    background-color:white;
                    padding:30px;
                    
                }
                .innerContainer{
                    width:90%;
                    margin:0 auto;
                }
                .logo{
                
                    display: block;
                    margin:0 auto;
                    height: 100px;
                    margin-bottom:20px;
                    
                }
                h1,h2{
                    text-align: center;
                font-size:;
                }
                table{
                text-align:center;
                margin:0 auto;
                width:95%;
                border-collapse: collapse;
                
                
                }
                td, th{
                border: 1px solid black;
                margin:0;
                padding-top: 12px;
                padding-bottom: 12px;
                }
                tr:nth-child(even)
                {
                background-color: #f2f2f2;
                }
                hr{
                height: 2px;
                border:none;
                background-color:lightgrey;
                }
                .footerStrong{
                    text-align:center;
                    margin-top:40px;
                }
                .footerText{
                text-align:center;
                }

            </style>
            </html>";



                
                $mail->Altbody = "Ren tekst";
                $mail->AddAddress($email); 
                if(!$mail->Send()){
                    print("<meta http-equiv='refresh' content='1;URL=http://opheimpi.zapto.org/www/sda/reko/access/login.php?msg=mail'/>");
                    
                 }
                 else{
                    print("<meta http-equiv='refresh' content='1;URL=http://opheimpi.zapto.org/www/sda/reko/access/login.php?msg=mail'/>");
                   
                 }
                 $mail->ClearAddresses();


            }
            else{
                print("Ingen treff på brukernavn/epost!");
            }
            
            
        }

?>
</div>
            <div class="login_footer">
                <a href="regUser.php"> Har du ikke en bruker? - Registrer deg nå!</a>
            </div>
        </div>
    </body>
</html>