<?php
$host="localhost";
$user="hakonopheim";
$password="5k0th31a1";
$database="reko";

$db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");

$keyword = $_GET["search"];

$sql = "SELECT * FROM users WHERE firstName LIKE '%$keyword%' OR lastName LIKE '%$keyword%' OR email LIKE '%$keyword%' OR userName LIKE '%$keyword%' OR role LIKE '%$keyword%' OR status LIKE '%$keyword%' order by lastName,firstName;";
$query = mysqli_query($db,$sql) or die ("Mislykkes å oppnå kontakt med database.");
$xRows = mysqli_num_rows($query);


if($xRows == 0){
	print("<h3>Registrerte Brukere:</h3>");
	print("<table class='prdOverview' border=1>");
	print("<tr><th>Fornavn</th> <th>Etternavn</th> <th>E-post</th> <th>Brukernavn</th> <th>Brukerrolle</th> <th>BrukerStatus</th> <th>#</th> </tr>");
	print("</table>");
}

else{
	print("<h3>Registrerte brukere:</h3>");
	print("<table class='prdOverview' border=1>");
	print("<tr><th>Fornavn</th> <th>Etternavn</th> <th>E-post</th> <th>Brukernavn</th> <th>Brukerrolle</th> <th>BrukerStatus</th> <th>#</th> </tr>");



	for($i=1 ; $i <= $xRows ; $i++){
		$row = mysqli_fetch_array($query);

		$firstName1=$row["firstName"];
		$lastName1=$row["lastName"];
		$email1=$row["email"];
		$userName1=$row["userName"];
		$role1=$row["role"];
		$status1=$row["status"];
		$userUserID1 = $row["userID"];

		switch ($status1){
			case "1":
				$status1 = "Aktiv";
			break;
			case "0":
				$status1 = "Innaktiv";
			break;
		}
		switch ($role1){
			case "moderator":
				$role1 = "Moderator";
			break;
			case "commerce":
				$role1 = "Leverandør";
			break;
			case "customer":
				$role1 = "Kunde";
			break;
		}
        
    

		print("<tr><td>$firstName1</td> <td>$lastName1</td> <td>$email1</td> <td>$userName1</td> <td>$role1</td> <td>$status1</td> <td><a href='/users/moderator/editUser.php?userID=$userUserID1'>Endre Bruker</a></tr>");

	}
	print("</table>");
}
?>