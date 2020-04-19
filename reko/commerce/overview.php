<?php include("../meny.php"); ?>
<div class="commerceContainer">
<div class="overview_info">
<h1>Våre lokale leverandører</h1>

<p>Under finner du en oversikt over leverandørene som er registrert i din reko ring, klikk på bilde for å
    lese mere om leverandøren, gårdsbruk eller se på hva leverandøren tilbyr.</p>

</div>
<div class="nygrid_cont">

<?php

$sql= "SELECT * FROM users WHERE role='commerce' and status='1' order by 'lastName';";
$result = mysqli_query($db,$sql) or die("ikke mulig å vise leverandørene");
$xRows = mysqli_num_rows($result);

for($x=1;$x <= $xRows; $x++){
    
    $part=mysqli_fetch_array($result);
    $userID = $part["userID"];
    $image = $part["image"];
    $firstName = $part["firstName"];
    $lastName = $part["lastName"];
    ?> 
    <div class="profileItem">
        <?php
        if(!$image){
            print("<a href='profile.php?ID=".$userID."'><img src='../img/default-profile.jpg'></a>");
        }
        else{
            print("<a href='profile.php?ID=".$userID."'><img src='../img/users/".$userID.'/'.$image."'></a>");
        }

    ?>
        <h2><a href='profile.php?ID=<?php print($userID);?>'><?php print($firstName.' '.$lastName);?></a><h2>
    </div>
    <?php

}
?>
</div></div>

<?php include("../footer1.php"); ?>