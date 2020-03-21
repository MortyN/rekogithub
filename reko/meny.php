<?php
session_start();
@$connectedUser=$_SESSION["userName"];
include("../db/connect.php");
?>

<!DOCTYPE html lang="no">
<head>
<meta charset="UTF-8">
<title>REKO - HORTEN</title>
<link rel="icon" href="/img/rekologo.png">
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?forceLang=no&theme=flying&always=1&noGeoIp=1&refreshPage=1&showNoConsent=1&hideDetailsBtn=1&showPolicyLink=1&remember=30&privacyPage=http%3A%2F%2Freko.opheim.as%2Fwww%2Fsda%2Freko%2Fpolicy.php"></script>
</head>
<body>
<?php
//Innlogget bruker
if($connectedUser){
    $sql404 = "SELECT * FROM users WHERE userName='$connectedUser' or email='$connectedUser';";
    $sqlQuery = mysqli_query($db,$sql404) or die ("Kan ikke hente data fra databasen (#100)");
    $del = mysqli_fetch_array($sqlQuery);

	$userFirstName=$del["firstName"];
    $userLastName=$del["lastName"];
    $userUserName = $del["userName"];
    $userPassword = $del["password"];
    $userRole = $del["role"];
    $userStatus = $del["status"];
    $userID = $del["userID"];
    ?>

        <div class="mainNav">
                <a class="logoomrad" href="/index.php"><img src="/img/rekologo.png" alt="LOGO"/></a>          
                <a href="/index.php">HJEM</a>
                <a href="/commerce/feed.php">FEED</a>
                <a href="commerce/overview.php">LEVERANDØRER</a>
                <a href="/contact.php">KONTAKTER</a>
                <a href="/faq.php">FAQ</a>
                <div class="dropdown">
                    <button class="dropbtn">MIN SIDE 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                    <a href="/commerce/dashboard.php">KONTROLLPANEL</a>
                    <a href="access/logout.php">LOGG UT</a>
                </div> 
            </div>
         </div>
         <?php
    
}
//Ikke logget inn
else{
    ?>
        <div class="mainNav">
                <a class="logoomrad" href="index.php"><img src="img/rekologo.png" alt="LOGO"/></a>          
                <a href="index.php">HJEM</a>
                <a href="commerce/feed.php">FEED</a>
                <a href="commerce/overview.php">LEVERANDØRER</a>
                <a href="contact.php">KONTAKTER</a>
                <a href="faq.php">FAQ</a>
                <div class="dropdown">
                    <button class="dropbtn">MIN SIDE 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                    <a href="access/login.php">LOGG INN</a>
                    <a href="access/regUser.php">REGISTRER DEG</a>
                    
                </div> 
            </div>
         </div>
<?php
}
    
?>
    