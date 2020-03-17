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

    $status=$_GET["status"];
?>

<div class="dashboard_content">
  <?php
    if ($status==1) {
      print ("<div class='messageDash'>");
      print ("<p>endring er no lagret</p>");
      print ("</div>");
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
      <img src="/www/sda/reko/img/users/<?php print($userID.'/'.$image);?>" height="100px"/>
      <input type="file" name="file"/><br>
      <input type="submit"  value="Endre" name="editProfile" id="editProfile">

    </form>
    <?php
        if (isset($_POST ["editProfile"]))
        {
          $userName=$_POST ["userName"];
          $firstName=$_POST ["firstName"];
          $lastName=$_POST ["lastName"];
          $email=$_POST ["email"];
          $profileIMG = $_POST["image"];

          $fileName=$_FILES ["file"]["name"];
	        $fileType=$_FILES ["file"]["type"];
          $tmpName=$_FILES ["file"]["tmp_name"];



         $path = "/var/www/html/www/sda/reko/img/users/".$userID.'/';

        if($fileName){
            
        $newPath="/var/www/html/www/sda/reko/img/users/".$userID.'/'.$fileName;

            if($fileType != "image/gif" && $fileType != "image/jpeg" && $fileType != "image/jpg" && $fileType != "image/png" ){
                print("<br><p>Filen må være et bilde.</p>");
            }
            if($profileIMG != $fileName){

                @unlink($path.$profileIMG);
                move_uploaded_file($tmpName, $newPath) or die ("<br><p>Kunne ikke laste opp bilde til serveren!</p>"); 

                $sql= "UPDATE users SET firstName ='$firstName',lastName ='$lastName',email='$email',image='$profileIMG' WHERE userID='$userID';";
                if(mysqli_query($db,$sql)){
                  print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?status=1'/>");
				        }
				        else{
                  print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?status=0'/>");
					        unlink($newPath) or die ("<br><p>Ikke mulig å slette bilde på serveren igjen</p>");
				        }
            }
            if($profileIMG == $fileName)
            {
                $sql= "UPDATE users SET firstName ='$firstName',lastName ='$lastName',email='$email' WHERE userID='$userID';";
                mysqli_query($db,$sql) or die ("<br><p>Kunne ikke oppdatere databasen!</p>");
                print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?status=1'/>");
            }
          else
            {
              $sql= "UPDATE users SET firstName ='$firstName',lastName ='$lastName',email='$email' WHERE userID='$userID';";
              mysqli_query($db,$sql) or die ("ikke mulig &aring; endre data i databasen");
              print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/profile/profile.php?status=1'/>");
            }
          }
        }
          ?>
  </div>
</div>
</html>