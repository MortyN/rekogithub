<?php include("meny.php"); ?>
<div class="commerceContainer">
<div class="overview_info">
<h1>Våre kontakpersoner</h1>

<p>Under finner du kontaktinformasjonen til våre moderatorer som du kan ta kontakt med hvis det er noe du lurer på.</p>

</div> 
<div class="nygrid_cont">


<?php

$sql= "SELECT * FROM users WHERE role='moderator' and status=1 order by RAND();";
$result = mysqli_query($db,$sql) or die("ikke mulig å vise moderatorer");
$xRows = mysqli_num_rows($result);

for($x=1;$x <= $xRows; $x++){
    
    $part=mysqli_fetch_array($result);
    $userID = $part["userID"];
    $image = $part["image"];
    $firstName = $part["firstName"];
    $lastName = $part["lastName"];
    $email = $part["email"];
    $phoneNumber = $part["phoneNumber"];

    
    ?>
    <div class="profileItem">
      <?php 
      if(!$image){
        print("<img src='img/default-profile.jpg'/>");
      }
      else{
        print("<img src='img/users/".$userID."/".$image."'/>");
      } 
      ?>
        <h2><a><?php print($firstName.' '.$lastName);?></a></h2>
        <p>Email:<?php print($email);?></p>
        <p>Tlf:<?php print($phoneNumber);?></p>
    </div>
    <?php

}
?> 
</div></div>
<?php include("footer1.php"); ?>