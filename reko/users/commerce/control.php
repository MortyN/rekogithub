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

    $newURL = "<meta http-equiv='refresh' content='0;URL=http://reko.opheim.as/users/".$userRole."/dashboard.php'/>";
    


    if($userRole != "commerce"){
        print($newURL);
    }
  }
    
?>
<html>
    <head>
        <title> Dashboard - Leverandør</title>
        <link rel="stylesheet" href="/stylesheet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
</head>
<body class="dashboard">
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
</div>
<script src="/users/commerce/sidebarfunction.js"></script>

<div class="Footer_panel">
<a> COPYRIGHT © 2020</a>
</div>