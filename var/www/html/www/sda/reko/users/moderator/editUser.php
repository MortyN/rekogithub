<?php

include ('control.php');
include('userFuntion.php');
$selectedUserID = $_GET['userID'];

  $sql = "SELECT * FROM users WHERE userID='$selectedUserID';";
  $sqlQuery = mysqli_query($db,$sql) or die ("Kan ikke hente data fra databasen (#100)");
  $del = mysqli_fetch_array($sqlQuery);

  
  
 
    $row = mysqli_fetch_array($sqlQuery);

    $firstName1=$row["firstName"];
    $lastName1=$row["lastName"];
    $email1=$row["email"];
    $userName1=$row["userName"];
    $role1=$row["role"];
    $status1=$row["status"];
    $userUserID = $row["userID"];

  

?>

<html>
<div class="profileeditor">
    <form method="post" action="">
      <label for="fname">Brukernavn:</label><br>
      <input type="text" id="userName" name="userName" value="<?php print($userName1); ?>" readonly><br>
      <label for="fname">Fornavn:</label><br>
      <input type="text" id="firstName" name="firstName" value="<?php print($firstName1); ?>"><br>
      <label for="lname">Etternavn:</label><br>
      <input type="text" id="lastName" name="lastName" value="<?php print($lastName1); ?>"><br>
      <label for="email">Email:</label><br>
      <input type="text" id="email" name="email" value="<?php print($email1); ?>"><br>
     
     
     
      <label for="role">Rolle:</label><br>
      <select name="role">
      <?php selectedRole($role) ?>
      </select>

      <label for="status">Status:</label><br>
      <select name="status">
      <?php status($status1);?> 
      </select><br>
      
      <img src="../img/users/<?php print($userUserID.'/'.$image);?>" height="100px"/>
      <select name='image'>
          <option value="imagedel">Slett bilde</option>
          <option value="" selected> Behold bilde</option>
      </select><br>


      <input type="submit"  value="Endre" name="editProfile" id="editProfile">
      

    </form>

    <?php
      if(ïsset($_POST['editProfile'])){
        $newUserName=$_POST['userName'];
        $newFirstName=$_POST['firstName'];
        $newLastName=$_POST['lastName'];
        $newEmail=$_POST['email'];

        $newStatus=$_POST['status'];
        $delIMG=$_POST['image'];

        
      }
      ?>
</div>
</html>