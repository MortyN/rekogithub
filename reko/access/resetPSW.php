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
                    <a>Brukernavn eller E-post:</a><br>
                    <input type="text" name="userName-Email" id="userName-Email" required/><br><br>
                    <a>Passord:</a><br>
                    <input type="password" name="password" id="password" require/><br>
                    <input type="submit" value="Logg inn!" name="logInButtom" /><br>


            


        <?php
        include("login_function/loginFunction.php");
         
        if (isset($_POST["logInButtom"])){
           
        }

?>
</div>
            <div class="login_footer">
                <a href="regUser.php"> Har du ikke en bruker? - Registrer deg nå!</a>
            </div>
        </div>
    </body>
</html>