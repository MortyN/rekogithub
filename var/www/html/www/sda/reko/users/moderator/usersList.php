<?php
include("control.php");

$sql = "SELECT * FROM users order by lastName, firstName";
$query = mysqli_query($db,$sql) or die ("Mislykkes å oppnå kontakt med database.");
$xRows = mysqli_num_rows($query);
?>

<div class="dashboard_content">
<div class="innerContainerPrdOverview">
    <div class="prdOverview_container">
        <p>Under ser du en oversikt over alle brukere som er i denne reko ringen. Bruk søkefeltet for raskere navigering. </p>
    </div>
    <div class="prdOverview_container">

        <script src ="ajax.js"></script>
        <div class="form">
            <form method="POST" action="">
                <h3> Her kan du søke etter brukere</h3>

                <p><a>Søkeord</a></p>
                <input type="text" id="search" name="search" onKeyUp="show(this.value)" placeholder="Søkeord"/>
                


                <div id="resultSearch">
                    <?php

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

                    print("<tr><td>$firstName1</td> <td>$lastName1</td> <td>$email1</td> <td>$userName1</td> <td>$role1</td> <td>$status1</td> <td><a href='/www/sda/reko/users/moderator/editUser.php?userID=$userUserID1'>Endre Bruker</a></tr>");
                }?>
                  </div>

        </form>
    </div>

</div></div>
    
