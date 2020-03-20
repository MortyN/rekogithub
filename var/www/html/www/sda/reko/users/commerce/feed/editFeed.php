<?php 
include("../control.php");

$sql="SELECT post.shortText, post.mainText, post.category, post.picture, post.heading, users.userName
FROM post
INNER JOIN users
ON users.userID = post.userID
where post.userID ='$userID';";

$result = mysqli_query($db,$sql) or die ("kan ikke hente inn post");
$xRows = mysqli_num_rows($result);

if($xRows != 1){ /*Dersom det ikke er registrert et innlegg fra før*/?>
    <div class="dashboard_content">
    <form class="grid-container" enctype="multipart/form-data" method="post" action="">
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
	
        <div class="item1">
            <h3>Her kan du laste opp din annonse.</h3>
            <p> Her kan du laste opp din annonse. Informasjonen du fylle ut her
            blir spredt utover siden, slik at kundene kan se hvem du er.
            I hovedfeltet skal du skrive utdypende om hvem du/dere er, hvordan dere driver
            I menyen til høyre kan du legge til bildet av gården, 
            samt skrive en kort beskrivelse av hvem du/dere er.<br>
            Etter hver reko samling, blir innlegget ditt satt som "innaktiv" 
            Du må derfor gå inn her igjen, og sette innlegget som aktivt igjen,
            for å bli synlig frem mot neste REKO samling. <br>
            Når du har opprettet ditt første innlegg, kan du når som helst gå tilbake hit for å endre innlegget ditt<br>
            Da vil all teksten du skriver nå bli lagret, slik at du slepper å skrive alt på nytt.</p>
    </div>
        <input type="txt" placeholder="OVERSKRIFT" class="item2" name="heading0" required/>
        <textarea class="item3" placeholder="Velkommen til vår gård! Her har vi 10 kuer ... Det du skriver her vil komme på din hovedside." rows="1" cols="50" wrap="physical" name="mainText0" required></textarea>
        <div class="item4">
            <h4> Innstillinger</h4> 
            <h5> Velg et bilde:</h5>
            <input type="file" id="file" class="postIMG" name="file" />
            <h5> Skriv en kort tekst:</h5>
            <textarea required class="shortText" placeholder="Det du skriver her vil komme i nyhetsfeeden.  Skriv kort og enkelt!" rows="1" cols="50" wrap="physical" name="shortText0"></textarea>
            <h5> Oppdater status:</h5>
            <select name="status0">
                <option value="">Status</option>
                <option value='Aktiv'>Aktiv</option>
                <option value='Innaktiv'>Innaktiv</option>
            </select><br>
            <input type="submit" value="Last opp!" name="submit"/>
        
    
            </div>
            </form>
  
<?php
    
    if(isset($_POST["submit"])){
        
        $heading0 = $_POST["heading0"];
        $shortText0 = $_POST["shortText0"];
        $status0 = $_POST["status0"];
        $mainText0 = $_POST["mainText0"];

        $fileName=$_FILES ["file"]["name"];
		$fileType=$_FILES ["file"]["type"];
        $tmpName=$_FILES ["file"]["tmp_name"];
       

        

        $newName="/var/www/html/www/sda/reko/img/users/".$userID.'/'.$fileName;
        $path="/var/www/html/www/sda/reko/img/users/".$userID.'/';

        
        
        if($fileType != "image/gif" && $fileType != "image/jpeg" && $fileType != "image/jpg" && $fileType != "image/png" ){
            print("<br><p>Filen må være et bilde.</p>");
        }
        else{
            
            if (!is_dir($path)) {
                $oldmask = umask(0);
                mkdir($path, 0777);   
                umask($oldmask);
                    
            }

			$sql="SELECT * FROM post WHERE picture='$fileName' and userID='$userID';";
			$query = mysqli_query($db,$sql) or die ("<br><p>Ikke mulig å kontakte databasen.</p>");
            $xRows = mysqli_num_rows($query);
    
			if($xRows != 0){
				print("<br><p>Bildet er registrert fra før!</p>");
            }
            
            else{
				move_uploaded_file($tmpName, $newName) or die ("<br><p>Kunne ikke laste opp bilde til serveren!</p>"); 

				$sql = "INSERT INTO post (shortText,mainText,picture,userID,category,heading) VALUES('$shortText0','$mainText0','$fileName','$userID','$status0','$heading0');";
				if(mysqli_query($db,$sql)){
					print("<br><p>Innlegget er nå lagret</p>");

				}
				else{
					print("<br><p>Ikke mulig å registrer på databasen.</p>");
					unlink($newName) or die ("<br><p>Ikke mulig å slette bilde på serveren igjen</p>");
				}
			}

            

        }
    }
?>


</div>
<?php 
} /*Dersom ingen innlegg er registrert fra før, slutt*/

if($xRows > 0){
    include("feedFunction.php");

    $part = mysqli_fetch_array($result);
        $heading = $part['heading'];
        $mainText = $part['mainText'];
        $postIMG = $part['picture'];
        $shortText = $part['shortText'];
        $status = $part['category'];
        
    ?>

    <div class="dashboard_content">
        <form class="grid-container" method="post" enctype="multipart/form-data" action="">
	        <div class="item1">
                <h3>Her kan du redigere din annonse.</h3>
                <p> Her kan du redigere din annonse. Informasjonen du skriver her er
                blir spredt utover siden, slik at kundene kan se hvem du er.
                I hovedfeltet skal du skrive utdypende om hvem du/dere er, hvordan dere driver
                I menyen til høyre kan du legge til bildet av gården, 
                samt skrive en kort beskrivelse av hvem dere er.<br>
                Etter hver reko samling, blir innlegget ditt satt som "innaktiv" 
                Du må derfor gå inn her igjen, og sette innlegge som aktivt igjen,
                for å komme med på neste ukers feed.</p>
            </div>
        <input type="txt" class="item2" name="heading1" value="<?php print($heading); ?>"/>
        <textarea class="item3" rows="1" cols="50" wrap="physical" name="maintext1"><?php print($mainText); ?></textarea>
        <div class="item4">
            <h4> Innstillinger</h4> 
            <h5> Velg et bilde:</h5>
            <h5> (La stå tom hvis du ikke vil endre)</h5>
            <input type="file" class="postIMG" id="file" name="file"/>
            <h5> Skriv en kort tekst:</h5>
            <textarea class="shortText" rows="1" cols="50" wrap="physical" name="shortText1"><?php print($shortText); ?></textarea>
            <h5> Oppdater status:</h5>
            <select name="status1">
                <option value="">Status</option>
                <?php current_status($status); ?>
            </select><br>
            <input type="submit" value="Lagre endringer!" name="submit1"/>
        </div>
        </form>
     <?php   
}
    if(isset($_POST['submit1'])){
        $heading1 = $_POST["heading1"];
        $shortText1 = $_POST["shortText1"];
        $status1 = $_POST["status1"];
        $mainText1 = $_POST["maintext1"];
        

        $fileName1=$_FILES ["file"]["name"];
		$fileType1=$_FILES ["file"]["type"];
        $tmpName1=$_FILES ["file"]["tmp_name"];
        
        
        $path1 = "/var/www/html/www/sda/reko/img/users/".$userID.'/';

        if($fileName1){
            
        $newName1="/var/www/html/www/sda/reko/img/users/".$userID.'/'.$fileName1;

            if($fileType1 != "image/gif" && $fileType1 != "image/jpeg" && $fileType1 != "image/jpg" && $fileType1 != "image/png" ){
                print("<br><p>Filen må være et bilde.</p>");
            }
            if($postIMG != $fileName1){

                @unlink($path1.$postIMG);
                move_uploaded_file($tmpName1, $newName1) or die ("<br><p>Kunne ikke laste opp bilde til serveren!</p>"); 
                $sql= "UPDATE post SET shortText ='$shortText1',mainText ='$mainText1',picture='$fileName1',category='$status1', heading='$heading1' WHERE userID='$userID';";
                if(mysqli_query($db,$sql)){
                    print("<br><p>Innlegget er nå lagret. <br> Oppdater siden for å se/endre endringen.</p>");
				}
				else{
					print("<br><p>Ikke mulig å registrer på databasen.</p>");
					unlink($newName1) or die ("<br><p>Ikke mulig å slette bilde på serveren igjen</p>");
				}
            }
            if($postIMG == $fileName1)
            {
                $sql= "UPDATE post SET shortText ='$shortText1',mainText ='$mainText1',category='$status1', heading='$heading1' WHERE userID='$userID';";
                mysqli_query($db,$sql) or die ("<br><p>Kunne ikke oppdatere databasen!1</p>");
                print("<br><p>Innlegget er nå lagret. <br> Oppdater siden for å se/endre endringen.</p>");
            }
    }
    if(!$fileName1){
            $sql= "UPDATE post SET shortText ='$shortText1',mainText ='$mainText1',category='$status1', heading='$heading1' WHERE userID='$userID';";
            mysqli_query($db,$sql) or die ("<br><p>Kunne ikke oppdatere databasen!2</p>");
            print("<br><p>Innlegget er nå lagret. <br> Oppdater siden for å se/endre endringen.</p>");
            


    }
}
    
?>
</div>



        
        
    
  
  

