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

                    $firstName=$row["firstName"];
                    $lastName=$row["lastName"];
                    $email=$row["email"];
                    $userName=$row["userName"];
                    $role=$row["role"];
                    $status=$row["status"];
                    $userUserID = $row["userID"];
                    
                

                    print("<tr><td>$firstName</td> <td>$lastName</td> <td>$email</td> <td>$userName</td> <td>$role</td> <td>$status</td> <td><a href='/www/sda/reko/users/commerce/products/editUser.php?userID=$userUserID'>Endre Bruker</a></tr>");
                ?>
                  </div>

        </form>
    </div>

</div>
    
</div>