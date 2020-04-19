<?php include("../meny.php"); 

$userPostID = $_GET['ID'];

$sql="SELECT users.firstName, users.lastName, post.mainText, post.heading, post.picture
FROM users
INNER JOIN post
ON users.userID = post.userID
WHERE users.userID = '$userPostID';";

$result = mysqli_query($db,$sql) or die ("kan ikke laste profil");
$xRows = mysqli_num_rows($result);


for($i=1;$i <= $xRows; $i++ ){
    $part = mysqli_fetch_array($result);
        $firstName = $part["firstName"];
        $lastName = $part["lastName"];
        $mainText = nl2br($part["mainText"]);
        $postIMG = $part["picture"];
        $title = $part["title"];
?>

<div class="profileContainer">
<?php
if (isset($_GET['error'])) {
    print("<div class='messageBox'>");
    print("<div class='redColorBox'></div>");

    $error = $_GET['error'];
    switch ($error)
    {
    case "sql":
        echo "<p><strong>Kan ikke bestille for øyeblikket</strong></p>";
    break;

    }
  print("</div>");
}
if (isset($_GET['success'])) {
        print("<div class='messageBox'>");
        print("<div class='greenColorBox'></div>");
    
        $error = $_GET['success'];
        switch ($error)
        {
        case "1":
            echo "<p><strong>Bestilling vellykket!</strong></p>";
        break;
    
        }
      print("</div>");
    }
?>

    <div class="headerPicture">
    
                <img class="headerImg" src="../img/users/<?php print($userPostID.'/'.$postIMG);?>"/>
        
                <h1> <?php print($firstName." ".$lastName); ?> </h1>
            </div>

    <div class="feedPost">
            
           <?php  print("<h2>".$title."</h2>");
                  print("<p>".$mainText."</p>");
           
           ?>

            
            </div>
    <div class="productPost">
    <?php  print("<h2>".$firstName." ".$lastName." sine produkter"."</h2>");

        $sql1 = "SELECT * FROM products WHERE commerceID = '$userPostID' and status='Aktiv';" ;
        $result1 = mysqli_query($db,$sql1) or die ("Kan ikke hente produkter");
        $rows = mysqli_num_rows($result1);

               
        $sql_innaktiv = "SELECT category FROM post WHERE userID = $userPostID;";
        $sql_test = mysqli_query($db,$sql_innaktiv) or die ("Kan ikke hente produkter.");
        $rowy = mysqli_fetch_array($sql_test);
        $status = $rowy["category"];

        if($status == "Aktiv"){

                print("<form method='POST' name='order' action=''>");
                print("<table>");
                print("<th>Produkt</th><th>Beskrivelse</th><th>Pris</th><th>Bestill</th>");

        for ($j = 1; $j<= $rows; $j++){
                $part1 = mysqli_fetch_array($result1);

                $title = $part1["title"];
                $description = $part1["description"];
                $price = $part1["price"];
                $unit = $part1["unit"];
                $productID = $part1["productID"];


                
                print("<tr>");
                
                print("<td>$title</td><td>$description</td><td>$price$unit</td><td><input type='text' name='product_$productID'/></td></tr>");
                
                
        }
           
           ?>
           </table>
           <?php
           if(!$connectedUser){
                   print("<p> Du må logge inn for å legge inn en bestilling");
           }
           else{
           print("<input type='submit' name='submit' value='Bestill'/>");
        }

}
else{
        print("<p>Det er ikke mulig å bestille fra denne leverandøren for øyeblikket.</p>");
}
        ?>
           </form>
           <?php 
           if(isset($_POST["submit"])){
                $date=date_create();

                $newDate = date_format($date,"Y-m-d");
                   

                $sql02 = "INSERT INTO orders (commerceID,customerID,status,date) VALUES ($userPostID,$userID,'Venter','$newDate');";
                
                
                mysqli_query($db,$sql02) or die("Kan ikke opprette ordrenr");
                

                $sql2 = "SELECT * FROM products WHERE commerceID = '$userPostID' and status='Aktiv';" ;
                
                $result2 = mysqli_query($db,$sql2) or die ("Kan ikke hente produkter");

                   for($k = 1; $k <= $rows; $k++){
                           $part2 = mysqli_fetch_array($result2);

                           $productID1 = $part2["productID"];
                           $productNewID = "product_" . $productID1;
                           

                           $quantity = $_POST[$productNewID];
                            if($quantity != ""){
                           $sql01 = "INSERT INTO productsOrders (orderID,productID,quantity) VALUES (LAST_INSERT_ID(),$productID1,$quantity);";
                           mysqli_query($db,$sql01) or die ("Kan ikke registrere ordre #productsOrders");
                           $validateTest = "completed";
                            }
                           
                   }
                   print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/commerce/profile.php?success=1&ID=$userPostID'/>");
                
           }
           
           ?>

    </div>
    <?php } ?>
</div>
<?php include("../footer.php"); ?>