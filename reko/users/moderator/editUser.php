<?php

include ('control.php');
include ('userFunction.php');
$selectedUserID = $_GET['userID'];

  $sql = "SELECT * FROM users WHERE userID='$selectedUserID';";
  $sqlQuery = mysqli_query($db,$sql) or die ("Kan ikke hente data fra databasen (#100)");

  $del = mysqli_fetch_array($sqlQuery);
  
  
  
 
    

    $firstName1=$del["firstName"];
    $lastName1=$del["lastName"];
    $email1=$del["email"];
    $userName1=$del["userName"];
    $role1=$del["role"];
    $status1=$del["status"];
    $image = $del['image'];
    $userUserID = $del["userID"];


?>

<html>
<div class="dashboard_content">
  <div class="innerContainerPrdOverview">
  
  <?php

          if (isset($_GET['error'])) {
            print("<div class='messageBox'>");
            print("<div class='redColorBox'></div>");
              $error = $_GET['error'];
              switch ($error)
              {
                case "sql":
                  echo "<p><strong>Kan ikke oppdatere i databasen. </strong></p>";
                break;

                case "server":
                  echo "<p><strong>Kan ikke oppdatere på serveren. </strong></p>";
                break;
                case "email":
                  echo "<p><strong>Ugyldig e-post</strong></p>";
                break;
            }
            print("</div>");
          }
          if (isset($_GET['success'])) {
            print("<div class='messageBox'>");
            print("<div class='greenColorBox'></div>");
                $success = $_GET['success'];
                switch ($success)
                {
                  case "updateOK":
                    echo "<p><strong>Endringen er oppdatert</strong></p>";
                  break;
                }  
                print("</div>");
          }
?>


              
         
    <div class="prdOverview_container">
          <p>Under ser du en oversikt over alle brukere som er i denne reko ringen. Bruk søkefeltet for raskere navigering. </p>
    </div>      

    <div class="prdOverview_container">
        <form method="post" name="editProfile" action="">

          <label for="fname">Brukernavn:</label><br>
          <input type="text" id="userName" name="userName" value="<?php print($userName1); ?>" ><br>
          <label for="fname">Fornavn:</label><br>
          <input type="text" id="firstName" name="firstName" value="<?php print($firstName1); ?>"><br>
          <label for="lname">Etternavn:</label><br>
          <input type="text" id="lastName" name="lastName" value="<?php print($lastName1); ?>"><br>
          <label for="email">Email:</label><br>
          <input type="text" id="email" name="email" value="<?php print($email1); ?>"><br>
        
        
        
          <label for="role">Rolle:</label><br>
          <select name="role">
          <?php selectedRole($role1) ?>
          </select>
          <br><br>

          <label for="status">Status:</label><br>
          <select name="status">
          <?php status($status1);?> 
          </select><br>
          
          <img src="../../img/users/<?php print($userUserID.'/'.$image);?>" height="100px"/>
          <select name='image'>
              <option value="imagedel">Slett bilde</option>
              <option value="" selected> Behold bilde</option>
          </select><br>

          



          <input type="submit" value="Endre" name="submit" id="submit"/>
          

        </form>

        <?php
          if(isset($_POST['submit'])){
            $newUserName=$_POST['userName'];
            $newFirstName=$_POST['firstName'];
            $newLastName=$_POST['lastName'];
            $newEmail=$_POST['email'];

            $newStatus=$_POST['status'];
            $newRole=$_POST['role'];
            
            $delIMG=$_POST['image'];

            

            if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
              echo "<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editUser.php?error=email&userID=$selectedUserID'>" and die;
          }


            if ($delIMG == "imagedel") {

              
              
              // Oppdater alle felt i database, samt slette fil fra server
              $query = "UPDATE users SET firstName = '$newFirstName', lastName = '$newLastName', email = '$newEmail', userName = '$newUserName', role = '$newRole', status = '$newStatus', image='' WHERE userID = '$selectedUserID';";
              mysqli_query($db,$query) or ("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editUser.php?error=sql&userID=$selectedUserID'>") and die;

              echo "<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editUser.php?success=updateOK&userID=$selectedUserID'>";


              
              

              $path="/var/www/html/www/sda/reko/img/users/".$userID.'/'.$image;
              unlink($path) or ("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editUser.php?error=server&userID=$selectedUserID'>") and die;

              


            }
            if(!$delIMG){
              if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                echo "<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editUser.php?error=email&userID=$selectedUserID'>";
              }
              $query = "UPDATE users SET firstName = '$newFirstName', lastName = '$newLastName', email = '$newEmail', userName = '$newUserName', role = '$newRole', status = '$newStatus', userID = '$selectedUserID' WHERE userID = '$selectedUserID';";      
              
              mysqli_query($db,$query) or ("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editUser.php?error=sql&userID=$selectedUserID'>") and die;
                  
              
              echo "<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editUser.php?success=updateOK&userID=$selectedUserID'>";
              
            }
          }
          ?>
    </div>
        </div>
  </div>
  </html>