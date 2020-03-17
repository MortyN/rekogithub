<?php include("../meny.php"); 

$sql="SELECT users.userID, users.firstName, users.lastName, users.image AS profileIMG, post.shortText, post.picture AS postIMG
from users
INNER JOIN post
on users.userID=post.userID
where post.category='Aktiv' and users.status='1'
ORDER BY RAND();";
$result = mysqli_query($db,$sql) or die ("kan ikke laste feed");
$xRows = mysqli_num_rows($result);
print("<div class='feed_container'>");
 
for($i=1;$i <= $xRows; $i++ ){
    $part = mysqli_fetch_array($result);
        $firstName = $part["firstName"];
        $lastName = $part["lastName"];
        $profileIMG = $part["profileIMG"];
        $shortText = $part["shortText"];
        $postIMG = $part["postIMG"];
        $userID = $part["userID"];
        
        ?>



<div class="post">
            
<div class="profileInfo">
        <img src="../img/users/<?php print($userID.'/'.$profileIMG);?>"/>      
          <p> <?php print($firstName." ".$lastName); ?> </p>
            </div>
<div class="content">
                <div class="ad__pic">

                </div>
                DIIIIIINOOOO????????
                WHERE U AT????
                <div class="ad_shortinfo">
                
                </div>

            </div>
            


</div>

<!-- Her Skal vi lage en grid. 
        <div class="feed_post">
            <div class="profileInfo">
                <a href="#linkTilProfil"><img src="../img/users/<?php /*print($userID.'/'.$profileIMG);?>" /></a><br>
                <p> <?php print($firstName." ".$lastName); ?> </p>
            </div>
            <div class="ad_pic">
                <img src="../img/users/<?php print($userID.'/'.$postIMG);?>"/>
            </div>
            <div class="ad_shortInfo">
                <p><?php print($shortText);*/?></p>
            </div>
    </div>-->


    
<?php
}
?>
</div>

<!--
    Profilbilde
    <img src="../img/users/<?php /* print($userID.'/'.$profileIMG);?>
    Postbilde
    <img src="../img/users/<?php print($userID.'/'.$postIMG);?>
 -->







<?php /*include("../footer.php"); */?> 