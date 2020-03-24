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
                <form method="POST" action="" name="loginForm">
                    <a>Nytt passord:</a><br>
                    <input type="password" name="password" id="password" require/><br>
                    <a>Gjenta nytt passord:</a><br>
                    <input type="password" name="rePassword" id="rePassword" require/><br>
                    <input type="submit" value="Tilbakestill" name="resetPassword" /><br>


            


        <?php
        
         
        if (isset($_POST["logInButtom"])){
            $token = $_GET['587'];

            $password=$_POST["password"];
            $rePassword=$_POST["rePassword"];

            if ($password != $rePassword){
                print("Passordene er ikke like.");
            }
            else{
                $cryptPassword = password_hash($password,PASSWORD_DEFAULT);

                $sql = "UPDATE users SET password ='$cryptPassword', token = '' WHERE token = '$token';";
                mysqli_query($db,$sql) or die ("Kan ikke tilbakestille passord.");
                print("Passordet er oppdatert");
                print("<br><a href='login.php'>Klikk her for å logge inn!</a>");
            }


           
        }

?>
</div>
            
        </div>
    </body>
</html>