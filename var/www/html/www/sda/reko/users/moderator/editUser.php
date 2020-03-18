<?php

include ('control.php');
$selectedUserID = $_GET['userID'];

  $sql = "SELECT * FROM users WHERE userID='$selectedUserID';";
  $sqlQuery = mysqli_query($db,$sql) or die ("Kan ikke hente data fra databasen (#100)");
  $del = mysqli_fetch_array($sqlQuery);

  
  
 
    $row = mysqli_fetch_array($query);

    $firstName=$row["firstName"];
    $lastName=$row["lastName"];
    $email=$row["email"];
    $userName=$row["userName"];
    $role=$row["role"];
    $status=$row["status"];
    $userUserID = $row["userID"];

  

?>

<html>
<div class="profileeditor">
    <form method="post" enctype="multipart/form-data" action="">
      <label for="fname">Brukernavn:</label><br>
      <input type="text" id="userName" name="userName" value="<?php print($userName); ?>" readonly><br>
      <label for="fname">Fornavn:</label><br>
      <input type="text" id="firstName" name="firstName" value="<?php print($firstName); ?>"><br>
      <label for="lname">Etternavn:</label><br>
      <input type="text" id="lastName" name="lastName" value="<?php print($lastName); ?>"><br>
      <label for="lname">Email:</label><br>
      <input type="text" id="email" name="email" value="<?php print($email); ?>"><br>
      <label for="lname">Rolle:</label><br>
      <input type="text" id="role" name="role" value="<?php print($role); ?>"><br>
      
      <img src="../img/users/<?php print($userID.'/'.$image);?>" height="100px"/>
    <select id='image'>
        <option value="imagedel">Slett bilde</option>
    </select>
      <input type="submit"  value="Endre" name="editProfile" id="editProfile">
      

    </form>
</div>
</html>