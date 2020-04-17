<?php 
session_start();
@$connectedUser=$_SESSION["userName"];

if(!$connectedUser ){
	print("<meta http-equiv='refresh' content='0;URL=http://reko.opheim.as/access/login.php'/>");
}
else{
$host="localhost";
$user="hakonopheim";
$password="5k0th31a1";
$database="reko";

$db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");



$sql = "SELECT * FROM users WHERE userName='$connectedUser' or email='$connectedUser';";
$sqlQuery = mysqli_query($db,$sql) or die ("Kan ikke hente data fra databasen (#100)");
$del = mysqli_fetch_array($sqlQuery);

	$userFirstName=$del["firstName"];
    $userLastName=$del["lastName"];
    $userUserName = $del["userName"];
    $userPassword = $del["password"];
    $userRole = $del["role"];
    $userStatus = $del["status"];
    $userID = $del["userID"];
    $userEmail = $del["email"];

    $newURL = "<meta http-equiv='refresh' content='0;URL=http://reko.opheim.as/users/".$userRole."/dashboard.php'/>";
    

    $timelog = "UPDATE users SET last_timestamp = CONVERT_TZ(NOW(),'+00:00','+4:00') WHERE userID = $userID;";
    mysqli_query($db,$timelog) or die("Failed to log time");
    if($userRole != "commerce"){
        print($newURL);
    }
  }
    
?>
<html>
    <head>
        <title> Dashboard - Leverandør</title>
        <link rel="stylesheet" media="screen and (min-width:1250px)"href="/stylesheet.css">
        <link rel="stylesheet" media="screen and (max-width:1250px)" href="/Mobile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <meta charset="UTF-8">
</head>
<body class="dashboard">
      <div class="mobileNav">
        <a href="/users/commerce/dashboard.php" class="active"><img class="mobileIMGBackend" src="http://reko.opheim.as/img/rekologo.png"/></a>
        <div id="mobileNavLinks">
        <a id="aMobile" href="/index.php">Til forsiden</a>
        <a id="aMobile" href="/users/commerce/dashboard.php">Info</a>
        <a id="aMobile" href="/users/commerce/chat/chat_overview.php">Dine meldinger</a><br>

        <h2>Annonse</h2>
        <a id="aMobile" href="/users/commerce/feed/editFeed.php">Rediger din annonse</a>
        <a id="aMobile" href="/users/commerce/feed/showFeed.php">Se annonse</a>
        <h2>Produkter</h2>
        <a id="aMobile" href="/users/commerce/products/addNewProduct.php">Legg til produkt</a>
        <a id="aMobile" href="/users/commerce/products/productOverview.php">Dine produkter</a>
        <h2>Ordre</h2>
        <a id="aMobile" href="/users/commerce/order/orderOverview.php">Mottatt bestillinger</a>
        <a id="aMobile" href="/users/commerce/order/orders.php">Dine bestillinger</a>

        
        <h2>Profil</h2>
        <a id="aMobile" href="/users/commerce/profile/profile.php">Din Profil</a>
        <a id="aMobile" href="/access/logout.php">Logg ut</a>


        </div>
  <a href="javascript:void(0);" class="icon" onclick="mobileNavChange()">
    <i class="fa fa-bars"></i>
  </a>
</div>
    <div class="top_header">
        
        <div class="profileWLC">
            <button class="dropdownBTN"><?php print(" Velkommen $userLastName, $userFirstName !");?></button>
            <div class="profile-content">
            <a href="/users/commerce/profile/profile.php">Endre profil</a>
            <a href="/access/logout.php">Logg ut</a>
            </div>
        </div>
    </div>
<div class="sidenav">
  <a href="/index.php">Til forsiden</a>
  <a href="/users/commerce/dashboard.php">Info</a>

  <button class="dropdown-btn">Annonse 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/users/commerce/feed/editFeed.php">Rediger din annonse</a>
    <a href="/users/commerce/feed/showFeed.php">Se annonse</a>

  </div>

  <button class="dropdown-btn">Produkter 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/users/commerce/products/addNewProduct.php">Legg til produkt</a>
    <a href="/users/commerce/products/productOverview.php">Dine produkter</a>
  </div>

  <button class="dropdown-btn">Ordre 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/users/commerce/order/orderOverview.php">Mottatt bestillinger</a>
    <a href="/users/commerce/order/orders.php">Dine bestillinger</a>
    
  </div>

  <button class="dropdown-btn">Profil 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/users/commerce/profile/profile.php">Din Profil</a>
    <a href="/access/logout.php">Logg ut</a>
    
  </div>
  <a href="/users/commerce/chat/chat_overview.php">Dine meldinger</a>
</div>
<script src="/users/commerce/sidebarfunction.js"></script>

<div class="Footer_panel">
<a> COPYRIGHT © 2020</a>
</div>
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