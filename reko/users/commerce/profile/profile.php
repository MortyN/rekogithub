<?php
  include ('../control.php');
  $sql = "SELECT * FROM users WHERE userID='$userID';";
  $sqlQuery = mysqli_query($db,$sql) or die ("Kan ikke hente data fra databasen (#100)");
  $del = mysqli_fetch_array($sqlQuery);

  	$firstName=$del["firstName"];
    $lastName=$del["lastName"];
    $userName=$del["userName"];
    $email=$del["email"];
    $image=$del["image"];
    $phone=$del["phoneNumber"];
    $status=$_GET["status"];
?>

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
        echo "<p><strong>Ugyldig email.</strong></p>";
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
  
  <div class="profileeditor">

  <h2> Din profil</h2>
    <form method="post" enctype="multipart/form-data" action="">
      <label for="fname">Brukernavn:</label><br>
      <input type="text" id="userName" name="userName" value="<?php print($userName); ?>" readonly><br>
      <label for="fname">Fornavn:</label><br>
      <input type="text" id="firstName" name="firstName" value="<?php print($firstName); ?>"><br>
      <label for="lname">Etternavn:</label><br>
      <input type="text" id="lastName" name="lastName" value="<?php print($lastName); ?>"><br>
      <label for="lname">Email:</label><br>
      <input type="text" id="email" name="email" value="<?php print($email); ?>"><br>
      <label for="lname">Telefon:</label><br>
      <input type="text" id="phone" name="phone" value="<?php print($phone); ?>"><br>
      <?php
      if(!$image){
        print("<img src='/www/sda/reko/img/default-profile.jpg' height='100px'/></a>");
      }
      else{
        print("<img src='/www/sda/reko/img/users/".$userID."/".$image."' height='100px'/>");
      }

      ?>
      
      <input type="file" name="file"/><br>
      <input type="submit"  value="Endre" name="editProfile" id="editProfile">
      <input type="submit" value="Slett bruker" class="deleteUser" name="delete" id="delete"/>

    </form>
    <button class="Passordchange" onclick="window.location.href = 'http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/editPassword.php';">Endre passord</button>
    <?php
        if (isset($_POST ["editProfile"]))
        {
          $userName1=$_POST ["userName"];
          $firstName1=$_POST ["firstName"];
          $lastName1=$_POST ["lastName"];
          $email1=$_POST ["email"];
          $phone1=$_POST ["phone"];

          $fileName=$_FILES ["file"]["name"];
	        $fileType=$_FILES ["file"]["type"];
          $tmpName=$_FILES ["file"]["tmp_name"];



         $path = "/var/www/html/www/sda/reko/img/users/".$userID.'/';
         
         if (!is_dir($path)) {
            $oldmask = umask(0);
            mkdir($path, 0777);   
            umask($oldmask);
                
        }
        
        if($fileName){
          
          
            
                $newPath="/var/www/html/www/sda/reko/img/users/".$userID.'/'.$fileName;
        

                if($fileType != "image/gif" && $fileType != "image/jpeg" && $fileType != "image/jpg" && $fileType != "image/png" )
                {
                  print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?error=picture'/>") and die;
                }
                
                if($profileIMG != $fileName)
                {

                    @unlink($path.$image);
                    move_uploaded_file($tmpName, $newPath) or ("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/commerce/products/editProduct.php?error=server'>") and die;

                    $sql= "UPDATE users SET firstName ='$firstName1',lastName ='$lastName',email='$email1',image='$fileName',phoneNumber='$phone1' WHERE userID='$userID';";
                    if(mysqli_query($db,$sql))
                        {
                          print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?success=updateOK'/>");
                        }
                    else
                        {
                          print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?error=sql'/>");
                          unlink($newPath) or ("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?error=server'/>'>") and die;
                        }
                }
                if($profileIMG == $fileName)
                  {
                      $sql= "UPDATE users SET firstName ='$firstName1',lastName ='$lastName',email='$email1',phoneNumber='$phone1' WHERE userID='$userID';";
                      mysqli_query($db,$sql) or ("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?error=sql'/>") and die;
                      print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?success=updateOK'/>");
                  }
                
                
          }
          else
              {
                
                
                
                $sql= "UPDATE users SET firstName ='$firstName1',lastName ='$lastName',email='$email1',phoneNumber='$phone1' WHERE userID='$userID';";
                mysqli_query($db,$sql) or ("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?error=sql'/>") and die;
                print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?success=updateOK'/>");
                
              }
            
        }
        if(isset($_POST['delete'])){
          include("../../functions.php");

          $result = delete_user($userID);

          if($result){
            print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/access/logout.php'/>");
          }
          else{
            print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/customer/profile/profile.php?error=delete'/>");
          }
          

        }
          ?>
  </div>
  </div>
  </div>
</html>