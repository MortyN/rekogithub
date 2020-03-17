<?php 
include("../control.php");

$sql="SELECT users.userID, users.firstName, users.lastName, users.image AS profileIMG, post.shortText, post.picture AS postIMG
from users
INNER JOIN post
on users.userID=post.userID
where users.userID = $userID
ORDER BY RAND();";
$result = mysqli_query($db,$sql) or die ("kan ikke laste feed");
$xRows = mysqli_num_rows($result);
print("<div class='dashboard_content'>");
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
<a href="profile.php?ID=<?php print($userID);?>"><img src="/www/sda/reko/img/users/<?php print($userID.'/'.$profileIMG);?>"/> </a>     
          <p> <?php print($firstName." ".$lastName); ?> </p>
            </div>
<div class="content">
                <div class="ad__pic">
                <img src="/www/sda/reko/img/users/<?php print($userID.'/'.$postIMG);?>"/>
                </div>
                <div class="ad_shortinfo">
                <p><?php print($shortText);?></p>
                </div>

            </div>
            


</div>
<?php
}
?>
</div>
</div>