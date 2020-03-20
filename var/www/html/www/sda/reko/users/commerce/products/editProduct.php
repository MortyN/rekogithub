<?php 
include("../control.php");
include("product_function.php");
print("<div class='dashboard_content'>");

$clickedPrdID = $_GET["prdID"];

$sql = "SELECT * FROM products WHERE productID='$clickedPrdID' and commerceID='$userID';";
$result=mysqli_query($db,$sql) or die("Kan ikke validere");
$num=mysqli_num_rows($result);
if($num > 1){?>
    <div class="innerContainerPrdOverview">
        <div class="prdOverview_container">
        <p>404 - Du har ikke tilgang til dette produktet! </p>
    </div>
</div>
<?php
}
else{

    $part = mysqli_fetch_array($result);

    $title = $part["title"];
    $description = $part["description"];
    $price = $part["price"];
    $unit = $part["unit"];
    $status = $part["status"];
?>
    
    <div class="innerContainerPrdOverview">
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
        <form class="grid-container" method="post" action="">
        
            <div class="item1">
                <h3>Endre produkt:</h3>
                <p> Her kan du endre valgt produkt. </p>
        </div>
            <input type="txt" value="<?php print($title); ?>" class="item2" name="title1" required/>
            <textarea class="item3" rows="1" cols="50" wrap="physical" name="description1" required><?php print($description); ?></textarea>
            <div class="item4">
                <h4> Innstillinger:</h4> 
                <h5> Pris</h5>
                <table class="settings">
                    <tr>
                        <td>
                            <input type="text" class="left" value="<?php print($price); ?>" name="price1" id="price" required/>
                        </td>
                        <td>
                            <select class="right" name="unit1" required>
                            <option value="">Enhet</option>
                            <?php selectedUnit($unit); ?>
                            </select><br>
                        </td>
                    </tr>
            </table>
            <h5>Status</h5>
                <select name="status1" required>
                    <option value="">Status</option>
                    <?php current_status($status); ?>
                </select><br>
                <input type="submit" value="Lagre" name="submit"/>
                </div>
                </div>
        
    
    <?php
    


        if(isset($_POST["submit"])){
            
            $title1 = $_POST["title1"];
            $description1 = $_POST["description1"];
            $price1 = $_POST["price1"];
            $unit1 = $_POST["unit1"];
            $status1 = $_POST["status1"];

            $sql = "UPDATE products SET title='$title1', description='$description1', price='$price1', unit='$unit1', status='$status1' WHERE productID='$clickedPrdID' and commerceID='$userID';";
            $result=mysqli_query($db,$sql) or ("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editProduct.php?error=sql&prdID=$clickedPrdID'>") and die;

            if($result){
                print("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/moderator/editProduct.php?success=updateOK&prdID=$clickedPrdID'>");
            }

        }
    ?>
    
    </form>

<?php
} ?>