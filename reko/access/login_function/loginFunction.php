<?php

function control($logInUserName,$logInPassword){
    include("/var/www/html/www/sda/reko/db/connect.php");
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
    $status = $xRows['status'];
    $check = false;

    

    $checkPassword = password_verify($logInPassword,$regPassword);
    if($regUserName != $logInUserName || $regEmail != $logInUserName && $checkPassword == false){
        
        $result = false;
    }
    if(!$status){
        $result = false;
    }
    else{
        return true;
    }
}
return $result;

}
function emailUsernameExist($userName_Email){
    include("/var/www/html/www/sda/reko/db/connect.php");

    $result = true;
    if(!$userName_Email){
        $result=false;
    }
    else{
    $sql="SELECT * FROM users WHERE userName='$userName_Email' or email='$userName_Email';";
    $sqlQuery=mysqli_query($db,$sql) or die("Ikke mulig &aring; hente data fra databasen (#300)");

    $rows = mysqli_num_rows($sqlQuery);
    }

    
    if($rows <= 0){
        $result = false;
    }
    else{
        $result = true;
    }
    return $result;

}