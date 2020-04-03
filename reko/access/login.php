<?php 
session_start();
@$connectedUser=$_SESSION["userName"];
include("/var/www/html/www/sda/reko/db/connect.php");

if($connectedUser ){
	


$sql = "SELECT * FROM users WHERE userName='$connectedUser';";
$sqlQuery = mysqli_query($db,$sql) or die ("Kan ikke hente data fra databasen (#100)");
$del = mysqli_fetch_array($sqlQuery);

	$userFirstName=$del["firstName"];
    $userLastName=$del["lastName"];
    $userUserName = $del["userName"];
    $userPassword = $del["password"];
    $userRole = $del["role"];
    $userStatus = $del["status"];

    $newURL = "http://opheimpi.zapto.org/www/sda/reko/users/";
    $newFile = "/dashboard.php'";

    switch ($userRole){
        case "customer":
            
            print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/'/>");
            break;

        case "admin":
            print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/admin/dashboard.php'/>");
            
            break;

        case "moderator":
          

            print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/moderator/dashboard.php'/>");
            break;

        case "commerce":
            

            print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/dashboard.php'/>");
            break;
        }
    }
    
?>
<!DOCTYPE html>
    <head>
    <meta charset="UTF-8">
    <title>REKO - HORTEN</title>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" media="screen and (max-width:1250px)" href="/www/sda/reko/Mobile.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen and (max-width:1250px)" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                    <a href="forgotPSW.php">Glemt passord?</a>


            


        <?php
        include("login_function/loginFunction.php");
        if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        if($msg == "mail"){
            print("<br>Sjekk mail for å tilbakestille passord.");
        }
        
        }
         
        if (isset($_POST["logInButtom"])){
            $logInUserName=$_POST["userName-Email"];
            $logInPassword=$_POST["password"];
    
            $logInControl=control($logInUserName,$logInPassword);
    
            if(!$logInControl){
                print("<br>Ingen treff på epost/brukernavn eller passord!");
            }
            
            else{
               
                $sql="SELECT * FROM users WHERE userName='$logInUserName' or email='$logInUserName';";
                $sqlQuery=mysqli_query($db,$sql) or die("Ikke mulig &aring; hente data fra databasen (#300)");
                $xRows=mysqli_fetch_array($sqlQuery);
                     $userRole=$xRows["role"];
                     $newURL = "http://opheimpi.zapto.org/www/sda/reko/users/";
                     $newFile = "/dashboard.php'";

                switch ($userRole){
                    case "customer":
                      
                        @$_SESSION["userName"] = $logInUserName;
                        
                        print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/'/>");
                        break;

                    case "admin":
                        
                        @$_SESSION["userName"] = $logInUserName;

                        print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/admin/dashboard.php'/>");
                        break;

                    case "moderator":
                        
                        @$_SESSION["userName"] = $logInUserName;

                        print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/moderator/dashboard.php'/>");
                        break;

                    case "commerce":
                        
                        @$_SESSION["userName"] = $logInUserName;

                        print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/dashboard.php'/>");
                        break;

                }
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