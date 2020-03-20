<?php include("../meny.php"); 

$sql="SELECT users.userID, users.firstName, users.lastName, users.image AS profileIMG, post.shortText, post.picture AS postIMG
from users
INNER JOIN post
on users.userID=post.userID
where post.category='Aktiv' and users.status='1'
ORDER BY RAND();";
$result = mysqli_query($db,$sql) or die ("kan ikke laste feed");
$xRows = mysqli_num_rows($result);
print("<div class='feed_container'>"); //1
 
    for($i=1;$i <= $xRows; $i++ ){
        $part = mysqli_fetch_array($result);
            $firstName = $part["firstName"];
            $lastName = $part["lastName"];
            $profileIMG = $part["profileIMG"];
            $shortText = $part["shortText"];
            $postIMG = $part["postIMG"];
            $userID = $part["userID"];
            
            ?>



            <div class="post"> //2
                        
                    <div class="profileInfo"> //3
                                <a href="profile.php?ID=<?php print($userID);?>"><img src="../img/users/<?php print($userID.'/'.$profileIMG);?>"/> </a>     
                                 <p> <?php print($firstName." ".$lastName); ?> </p>
                    </div>//1-
                                <div class="content">//4
                                    <div class="ad__pic">//5
                                        <img src="../img/users/<?php print($userID.'/'.$postIMG);?>"/>
                                    </div>//-2
                                    <div class="ad_shortinfo">//6
                                        <p><?php print($shortText);?></p>
                                    </div>//-3

                                </div>//-4
                                


            </div>//-5

<?php

}
?>
</div>//-6

<?php include("../footer.php"); ?>