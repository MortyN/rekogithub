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
            print("Test - Feil validering");

            if($userExist){

                $token = bin2hex(random_bytes(30));
                $sql = "UPDATE users SET token = $token WHERE userName = '$userName_Email' or email = '$userName_Email';";
                print($sql);
                $sqlQuery = mysqli_query($db,$sql) or die("Ikke mulig &aring; hente data fra databasen ");

                $resetLink = "http://opheimpi.zapto.org/www/sda/reko/access/resetPSW.php?".$token;
                

                //Generer token #
                //Last opp token til db
                //Generer link til resetPWS.php med token
                //Lag og send mail med link. 




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