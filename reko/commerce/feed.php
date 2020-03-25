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
            $shortText = nl2br($part["shortText"]);
            $postIMG = $part["postIMG"];
            $userID = $part["userID"];
            
            ?>



            <div class="post">
                        
                    <div class="profileInfo">
                    <?php
                            if(!$profileIMG){
                                print("<a href='profile.php?ID=".$userID."'><img src='../img/default-profile.jpg'/> </a>");
                                
                            }
                            else{
                                print("<a href='profile.php?ID=".$userID."'><img src='../img/users/".$userID."/".$profileIMG."'/> </a>");
                            }

                            ?>
                                     
                                 <p> <?php print($firstName." ".$lastName); ?> </p>
                    </div>
                                <div class="content">
                                    <div class="ad__pic">
                                        <img src="../img/users/<?php print($userID.'/'.$postIMG);?>"/>
                                    </div>
                                    <div class="ad_shortinfo">
                                        <p><?php print($shortText);?></p>
                                    </div>
                                    <a href='profile.php?ID=<?php print($userID); ?>'><button class="feedBTN">Bestill nå!</button> 

                                </div>
                                
                                


            </div>

<?php
}
?>
</div>

<?php include("../footer.php"); ?>