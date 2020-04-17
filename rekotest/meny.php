<?php
session_start();
@$connectedUser=$_SESSION["userName"];
include("db/connect.php");
?>

<!DOCTYPE html lang="no">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>REKO - HORTEN</title>
<link rel="icon" href="/img/rekologo.png">
<link rel="icon" media="screen and (max-width:1250px)" href="/img/rekologo.png">

<link rel="stylesheet" href="/stylesheet.css">
<link rel="stylesheet" media="screen and (max-width:1250px)" href="/Mobile.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" media="screen and (max-width:1250px)" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?forceLang=no&theme=flying&always=1&noGeoIp=1&refreshPage=1&showNoConsent=1&hideDetailsBtn=1&showPolicyLink=1&remember=30&privacyPage=http%3A%2F%2Fopheimpi.zapto.org%2Fwww%2Fsda%2Freko%2Fpolicy.php"></script>
<script type="text/javascript" src="functionsNavbar.js"></script>
<script type="text/javascript" src="/functionsNavbar.js"></script>
<script type="text/javascript" src="functionsNavbar.js"></script>
<script>
function mobileNavChange() {
  var x = document.getElementById("mobileNavLinks");

  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
  
}
</script>

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

    $timelog = "UPDATE users SET last_timestamp = CONVERT_TZ(NOW(),'+00:00','+4:00') WHERE userID = $userID;";
    mysqli_query($db,$timelog) or die("Failed to log time");
    ?>
        <div class="mobileNav">
        <a href="/index.php" class="active"><img class="mobileIMGBackend" src="http://reko.opheim.as/img/rekologo.png"/></a>
        <div id="mobileNavLinks">
        <a id="aMobile" href="/index.php">HJEM</a>
        <a id="aMobile" href="/commerce/feed.php">ANNONSER</a>
        <a id="aMobile" href="/commerce/overview.php">LEVERANDØRER</a>
        <a id="aMobile" href="/contact.php">KONTAKTER</a>
        <a id="aMobile" href="/faq.php">HJELP</a>
        <h2>Min Side</h2>
        <a id="aMobile" href="/users/commerce/dashboard.php">KONTROLLPANEL</a>
        <a id="aMobile" href="/access/logout.php">LOGG UT</a>


        </div>
  <a href="javascript:void(0);" class="icon" onclick="mobileNavChange()">
    <i class="fa fa-bars"></i>
  </a>
</div>
        <div class="mainNav" id="topNav">
                <a class="logoomrad" href="/index.php"><img src="/img/rekologo.png" alt="LOGO"/></a>          
                <a href="/index.php">HJEM</a>
                <a href="/commerce/feed.php">ANNONSER</a>
                <a href="/commerce/overview.php">LEVERANDØRER</a>
                <a href="/contact.php">KONTAKTER</a>
                <a href="/faq.php">HJELP</a>
                <div class="dropdown">
                    <button class="dropbtn">MIN SIDE 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                    <a href="/users/commerce/dashboard.php">KONTROLLPANEL</a>
                    <a href="/access/logout.php">LOGG UT</a>
                </div> 
            </div>
         </div>
         <?php
    
}
//Ikke logget inn
else{
    ?>
    <div class="mobileNav">
        <a href="/index.php" class="active"><img class="mobileIMGBackend" src="http://reko.opheim.as/img/rekologo.png"/></a>
        <div id="mobileNavLinks">
        <a id="aMobile" href="/index.php">HJEM</a>
        <a id="aMobile" href="/commerce/feed.php">ANNONSER</a>
        <a id="aMobile" href="/commerce/overview.php">LEVERANDØRER</a>
        <a id="aMobile" href="/contact.php">KONTAKTER</a>
        <a id="aMobile" href="/faq.php">HJELP</a>
        <h2>Min Side</h2>
        <a id="aMobile" href="/access/login.php">LOGG INN</a>
        <a id="aMobile" href="/access/regUser.php">REGISTRER DEG</a>


        </div>
  <a href="javascript:void(0);" class="icon" onclick="mobileNavChange()">
    <i class="fa fa-bars"></i>
  </a>
</div>
        <div class="mainNav" id="topNav">
                <a class="logoomrad" href="/index.php"><img src="/img/rekologo.png" alt="LOGO"/></a>          
                <a href="/index.php">HJEM</a>
                <a href="/commerce/feed.php">ANNONSER</a>
                <a href="/commerce/overview.php">LEVERANDØRER</a>
                <a href="/contact.php">KONTAKTER</a>
                <a href="/faq.php">HJELP</a>
                <div class="dropdown">
                    <button class="dropbtn">MIN SIDE 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                    <a href="/access/login.php">LOGG INN</a>
                    <a href="/access/regUser.php">REGISTRER DEG</a>
                    
                </div> 
            </div>
         </div>
<?php
}
    
?>
    