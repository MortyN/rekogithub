<?php
session_start();
@$connectedUser=$_SESSION["userName"];
include("/var/www/html/www/sda/reko/db/connect.php");
?>

<!DOCTYPE html lang="no">
<head>
<meta charset="UTF-8">
<title>REKO - HORTEN</title>
<link rel="icon" media="screen and (orientation:landscape)" href="/www/sda/reko/img/rekologo.png">
<link rel="icon" media="screen and (orientation:portrait)" href="/www/sda/reko/img/rekologo.png">

<link rel="stylesheet" media="screen and (min-width:1200px)" href="/www/sda/reko/stylesheet.css">
<link rel="stylesheet" media="screen and (min-width:500px)" href="/www/sda/reko/Mobile.css">

<link rel="stylesheet" media="screen and (orientation:landscape)" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" media="screen and (orientation:portrait)" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?forceLang=no&theme=flying&always=1&noGeoIp=1&refreshPage=1&showNoConsent=1&hideDetailsBtn=1&showPolicyLink=1&remember=30&privacyPage=http%3A%2F%2Fopheimpi.zapto.org%2Fwww%2Fsda%2Freko%2Fpolicy.php"></script>
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
                <a class="logoomrad" href="/www/sda/reko/index.php"><img src="/www/sda/reko/img/rekologo.png" alt="LOGO"/></a>          
                <a href="/www/sda/reko/index.php">HJEM</a>
                <a href="/www/sda/reko/commerce/feed.php">ANNONSER</a>
                <a href="/www/sda/reko/commerce/overview.php">LEVERANDØRER</a>
                <a href="/www/sda/reko/contact.php">KONTAKTER</a>
                <a href="/www/sda/reko/faq.php">HJELP</a>
                <div class="dropdown">
                    <button class="dropbtn">MIN SIDE 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                    <a href="/www/sda/reko/users/commerce/dashboard.php">KONTROLLPANEL</a>
                    <a href="/www/sda/reko/access/logout.php">LOGG UT</a>
                </div> 
            </div>
         </div>
         <?php
    
}
//Ikke logget inn
else{
    ?>
        <div class="mainNav">
                <a class="logoomrad" href="/www/sda/reko/index.php"><img src="/www/sda/reko/img/rekologo.png" alt="LOGO"/></a>          
                <a href="/www/sda/reko/index.php">HJEM</a>
                <a href="/www/sda/reko/commerce/feed.php">ANNONSER</a>
                <a href="/www/sda/reko/commerce/overview.php">LEVERANDØRER</a>
                <a href="/www/sda/reko/contact.php">KONTAKTER</a>
                <a href="/www/sda/reko/faq.php">HJELP</a>
                <div class="dropdown">
                    <button class="dropbtn">MIN SIDE 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                    <a href="/www/sda/reko/access/login.php">LOGG INN</a>
                    <a href="/www/sda/reko/access/regUser.php">REGISTRER DEG</a>
                    
                </div> 
            </div>
         </div>
<?php
}
    
?>
    