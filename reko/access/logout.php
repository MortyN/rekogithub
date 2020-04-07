<?php 
session_start();
$host="localhost";
$user="hakonopheim";
$password="5k0th31a1";
$database="reko";
$logInUserName = $_SESSION['userName'];
$db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");

session_destroy();
header('Location: '.'../index.php');
?>