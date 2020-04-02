<?php 
session_start();
$host="localhost";
$user="hakonopheim";
$password="5k0th31a1";
$database="reko";

$db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");
$sql_active = "UPDATE users SET onlineStatus = 'Offline' where userName='$logInUserName or email='$logInUserName';";
                mysqli_query($db,$sql_active) or die ("Kan ikke oppdatere");
session_destroy();
header('Location: '.'../index.php');
?>