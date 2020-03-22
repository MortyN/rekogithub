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
                    <a>Fornavn:</a><br>
                    <input type="text" name="firstName" id="firstName" required/><br><br>
                    <a>Etternavn:</a><br>
                    <input type="text" name="lastName" id="lastName" required/><br><br>
                    <a>E-post:</a><br>
                    <input type="text" name="eMail" id="eMail" required/><br><br>
                    <a>Brukernavn:</a><br>
                    <input type="text" name="userName" id="userName" required/><br><br>
                    <a>Passord:</a><br>
                    <input type="password" name="password1" id="password1" required/><br><br>
                    <a>Gjenta passord:</a><br>
                    <input type="password" name="rePassword" id="rePassword" required/><br><br>
                        
                    <input type="submit" value="Registrer!" name="submit" /><br>

                  
           

<?php

    if (isset($_POST["submit"]))
    {
        
        
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $eMail = $_POST["eMail"];
        $userName = $_POST["userName"];
        $password1 = $_POST["password1"];
        $rePassword = $_POST["rePassword"];
        include("/var/www/html/www/sda/reko/db/connect.php");

        if(!$firstName || !$lastName || !$eMail || !$password1 || !$rePassword || !$userName ){
            print("Du må fylle inn alle felt!");
        }
        if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
            print("Ugyldig email!") and die; 
        }
          
        
        if($password1 != $rePassword){
            print("Passordene er ikke like!");
        }
        else{
        $sql = "SELECT * FROM users WHERE userName='$userName';"; 
        $sqlQuery=mysqli_query($db,$sql) or die ("Ikke mulig &aring; hente data fra databasen! (#reg1)");
        $rows=mysqli_num_rows($sqlQuery); /*Returnerer antall ganger bruker er registrert fra før*/

            if($rows >= 1)
            {
                print("Brukeren er allerede registrert!");
                print("<br><a href='login.php'>Klikk her for å logge inn!</a>");
                
            }
            
            else{
                $sql = "SELECT * FROM users WHERE email='$eMail';"; 
                $sqlQuery=mysqli_query($db,$sql) or die ("Ikke mulig &aring; hente data fra databasen! (#reg2)");
                $rows=mysqli_num_rows($sqlQuery); /*Returnerer antall ganger classCode er registrert fra før*/
            
                if($rows >= 1)
                {
                    print("Eposten er allerede registrert!");
                    print("<br><a href='login.php'>Klikk her for å logge inn!</a>");
                }
                else{
                    $cryptPassword = password_hash($password1,PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (firstName,lastName,email,userName,password,role,status) VALUES ('$firstName', '$lastName', '$eMail', '$userName', '$cryptPassword', 'customer', '1');";
                    mysqli_query($db,$sql) or die ("Ikke mulig m&aring; å registrere bruker på databasen! (#200)");
                    print("Brukeren er registrert");
                    print("<br><a href='login.php'>Klikk her for å logge inn!</a>");
                 }
            }



        
            

        
    }
}
?>
 </div>
        </div>


       
        
    </body>

</html>
