<?php
session_start();
@$connectedUser=$_SESSION["userName"];
include("/var/www/html/www/sda/reko/db/connect.php");
?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>REKO - HORTEN</title>
<link rel="stylesheet" href="/www/sda/reko/stylesheet.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
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
                
                <a href="/www/sda/reko/index.php">HJEM</a>
                <a href="/www/sda/reko/commerce/feed.php">FEED</a>
                <a href="/www/sda/reko/commerce/overview.php">LEVERANDØRER</a>
                <a href="/www/sda/reko/contact.php">KONTAKTER</a>
                <a href="/www/sda/reko/faq.php">FAQ</a>
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
else{
    ?>
        <div class="mainNav">
                
                <a href="/www/sda/reko/index.php">HJEM</a>
                <a href="/www/sda/reko/commerce/feed.php">FEED</a>
                <a href="/www/sda/reko/commerce/overview.php">LEVERANDØRER</a>
                <a href="/www/sda/reko/contact.php">KONTAKTER</a>
                <a href="/www/sda/reko/faq.php">FAQ</a>
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
    