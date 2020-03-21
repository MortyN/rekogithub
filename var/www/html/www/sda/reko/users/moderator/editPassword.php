<?php
include ('control.php');
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
                case "loginerror":
                  echo "<p><strong>Feil passord</strong></p>";
                break;

                case "sql":
                  echo "<p><strong>Kan ikke oppdatere passord. </strong></p>";
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
                    echo "<p><strong>Passordet er nå endret</strong></p>";
                  break;
                }  
                print("</div>");
          }
?>
            <div class="editPasswordBox">
                <h2> Endre passord </h2>
                    <form method="post" enctype="multipart/form-data" action="">
                            <label for="fname">Nåværende Passord:</label><br>
                            <input type="text" id="password" name="password" value=""><br>
                            <label for="fname">Nytt Passord:</label><br>
                            <input type="text" id="newPassword" name="newPassword" value=""><br>
                            <label for="lname">Gjenta Passord:</label><br>
                            <input type="text" id="newPassword" name="reNewPassword" value=""><br>

                            <input type="submit" value="Endre" name="change"/>


                    </form>
            </div>
            <?php
                if(isset($_POST['change'])){
                    include("logInFunction.php");

                    $password=$_POST['password'];
                    $newPassword=$_POST['newPassword'];
                    $renewPassword=$_POST['reNewPassword'];

                    $result = control($userUserName,$password);
                    if(!$result){
                        print("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editPassword.php?error=loginerror'>");
                    }
                    else{
                        $cryptPassword = password_hash($newPassword,PASSWORD_DEFAULT);
                        $sql = "UPDATE users SET password='$cryptPassword' WHERE userID=$userID;";
                        mysqli_query($db,$sql) or ("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editPassword.php?error=sql'>") and die;
                        print("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editPassword.php?success=updateOK'>");
                    }
               
                }




                ?>

    </div>
</div>