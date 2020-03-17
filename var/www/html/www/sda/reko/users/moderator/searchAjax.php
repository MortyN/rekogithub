<?php
$host="localhost";
$user="hakonopheim";
$password="5k0th31a1";
$database="reko";

$db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");

$keyword = $_GET["search"];

$sql = "SELECT * FROM users WHERE firstName LIKE '%$keyword%' OR lastName LIKE '%$keyword%' OR email LIKE '%$keyword%' OR userName LIKE '%$keyword%' OR role LIKE '%$keyword%' OR status LIKE '%$keyword%';";
$query = mysqli_query($db,$sql) or die ("Mislykkes å oppnå kontakt med database.");
$xRows = mysqli_num_rows($query);


if($xRows == 0){
	print("<h3>Registrerte Brukere:</h3>");
	print("<table class='prdOverview' border=1>");
	print("<tr><th>Fornavn</th> <th>Etternavn</th> <th>E-post</th> <th>Brukernavn</th> <th>Brukerrolle</th> <th>BrukerStatus</th></tr>");
	print("</table>");
}

else{
	print("<h3>Registrerte brukere:</h3>");
	print("<table id='prdOverview' border=1>");
	print("<tr><th>Fornavn</th> <th>Etternavn</th> <th>E-post</th> <th>Brukernavn</th> <th>Brukerrolle</th> <th>BrukerStatus</th></tr>");



	for($i=1 ; $i <= $xRows ; $i++){
		$row = mysqli_fetch_array($query);

		$firstName=$row["firstName"];
		$lastName=$row["lastName"];
		$email=$row["email"];
		$userName=$row["userName"];
		$role=$row["role"];
        $status=$row["status"];
        
    

		print("<tr><td>$firstName</td> <td>$lastName</td> <td>$email</td> <td>$userName</td> <td>$role</td> <td>$status</td></tr>");

	}
	print("</table>");
}
?>