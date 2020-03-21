<?php

function control($logInUserName,$logInPassword){
    include("/var/www/html/db/connect.php");
    $result=true;


    if(!$logInUserName || !$logInPassword){
        $result=false;
    }
    else{
    
    
    $sql="SELECT * FROM users WHERE userName='$logInUserName' or email='$logInUserName';";
    $sqlQuery=mysqli_query($db,$sql) or die("Ikke mulig &aring; hente data fra databasen (#300)");

    $xRows=mysqli_fetch_array($sqlQuery);
    $regUserName=$xRows["userName"];
    $regEmail=$xRows["email"];
    $regPassword=$xRows["password"];
    $check = false;

    

    $checkPassword = password_verify($logInPassword,$regPassword);
    if($regUserName != $logInUserName || $regEmail != $logInUserName && $checkPassword == false){
        
        $result = false;
    }
    else{
        return true;
    }
}
return $result;




}