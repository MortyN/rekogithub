<?php 
session_start();
@$connectedUser=$_SESSION["userName"];

if(!$connectedUser ){
	print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/access/login.php'/>");
}
else{
$host="localhost";
$user="hakonopheim";
$password="5k0th31a1";
$database="reko";

$db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");




                            //MAIL DETAILS
                           



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

    $newURL = "<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/".$userRole."/dashboard.php'/>";
    


    if($userRole != "customer"){
        print($newURL);
    }
  }
    
?>
<html>
    <head>
        <title> Dashboard - Kunde</title>
        <link rel="stylesheet" href="/www/sda/reko/stylesheet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
</head>
<body class="dashboard">
    <div class="top_header">
        
        <div class="profileWLC">
            <button class="dropdownBTN"><?php print(" Velkommen $userLastName, $userFirstName !");?></button>
            <div class="profile-content">
            <a href="/www/sda/reko/users/customer/profile/profile.php">Endre profil</a>
            <a href="/www/sda/reko/access/logout.php">Logg ut</a>
            </div>
        </div>
    </div>
<div class="sidenav">
  <a href="/www/sda/reko/index.php">Til forsiden</a>
  <a href="/www/sda/reko/users/customer/dashboard.php">Info</a>
    <a href="/www/sda/reko/users/customer/profile/orders.php">Dine ordre</a>
    <a href="/www/sda/reko/users/customer/profile/profile.php">Endre profil</a>
    <a href="/www/sda/reko/access/logout.php">Logg ut</a>


  
</div>
<script src="/www/sda/reko/users/commerce/sidebarfunction.js"></script>

<div class="Footer_panel">
<a> COPYRIGHT © 2020</a>
</div>