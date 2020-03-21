<?php
session_start();
@$connectedUser=$_SESSION["userName"];

if(!$connectedUser ){
	print("<meta http-equiv='refresh' content='0;URL=http://reko.opheim.as/access/login.php'/>");
}
else{
  $host="localhost";
  $user="opheimoc_reko";
  $password="rekodev69";
  $database="opheimoc_reko";
  
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



    if($userRole != "moderator"){
        print($newURL);
    }
  }

?>
<html>
    <head>
        <title> Dashboard - Moderator</title>
        <link rel="icon" href="/img/rekologo.png">
        <link rel="stylesheet" href="/stylesheet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
</head>
<body class="dashboard">
    <div class="top_header">

        <div class="profileWLC">
            <button class="dropdownBTN"><?php print(" Velkommen $userLastName, $userFirstName !");?></button>
            <div class="profile-content">
            <a href="/users/moderator/profile.php">Endre profil</a>
            <a href="/access/logout.php">Logg ut</a>
            </div>
        </div>
    </div>
<div class="sidenav">
  <a href="/index.php">Til forsiden</a>
  <a href="/users/moderator/dashboard.php">Info</a>
  <a href="/users/moderator/usersList.php">Brukerlister</a>
  <a href="/users/moderator/orders.php">Dine Ordre</a>

  <button class="dropdown-btn">Profil
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/users/moderator/profile.php">Din Profil</a>
    <a href="/access/logout.php">Logg ut</a>

  </div>
</div>
<script src="/users/commerce/sidebarfunction.js"></script>


<div class="Footer_panel">
<a> REKO © 2020</a>
</div>
