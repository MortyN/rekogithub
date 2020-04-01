<!DOCTYPE html>
    <head>
    <meta charset="UTF-8">
    <title>REKO - HORTEN</title>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
   <?php    
        $siteKey = '6LdwzeUUAAAAALPDLyDOm1qRsZx-VWmPhgAwgFgt';
        $secret = '6LdwzeUUAAAAAASNXh9LqUch-41b7jSmLE1ZgYco';
         
       /* $recaptcha = new \ReCaptcha\ReCaptcha($secret);
         
        $gRecaptchaResponse = $_POST['g-recaptcha-response']; //google captcha post data
        $remoteIp = $_SERVER['REMOTE_ADDR']; //to get user's ip
         
        $recaptchaErrors = ''; // blank varible to store error
         
        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp); //method to verify captcha
        if ($resp->isSuccess()) {
           // send mail or insert in db or do whatver you wish to
        } else {
           $recaptchaErrors = $resp->getErrorCodes(); // set the error in varible
        }*/
   ?>
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
                    
                    <div class="g-recaptcha" data-sitekey="<?php echo $sitekey;?>"></div>

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
            print("Du må fylle inn alle felt!") and die; 
        }
        if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
            print("Email is invalid")and die;
          } 
        if($password1 != $rePassword){
            print("Passordene er ikke like!") and die; 
        }
        
        if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
          }
        if(!$captcha){
            echo '<h2>Please check the the captcha form.</h2>';
            exit;
          }
          $secret = "Put your secret key here";
          $ip = $_SERVER['REMOTE_ADDR'];
          // post request to server
          $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret) .  '&response=' . urlencode($captcha);
          $response = file_get_contents($url);
          $responseKeys = json_decode($response,true);
          // should return JSON with success as true
          if($responseKeys["success"]) {

                  echo '<h2>registrert bruker</h2>';

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