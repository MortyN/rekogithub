<?php 
include("../control.php");
include("product_function.php");?>

    <div class="dashboard_content">
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
            <h3>Her kan du laste opp dine produkter</h3>
            <p> Her kan du laste opp ett produkt. Produktene vil komme opp under ditt personlige innlegg,
                Kunden vil kun ha mulighet til å bestille de produktene som er i din produktliste.</p>
    </div>
        <input type="txt" placeholder="Navn på produkt" class="item2" name="title" required/>
        <textarea class="item3" placeholder="Kort beskrivelse av produktet, hvordan det er pakket, oppbevaringstid osv.." rows="1" cols="50" wrap="physical" name="description" required></textarea>
        <div class="item4">
            <h4> Innstillinger:</h4> 
            <h5> Pris</h5>
            <table class="settings">
                <tr>
                    <td>
                        <input type="text" class="left" placeholder="199.79" name="price" id="price" required/>
                    </td>
                    <td>
                        <select class="right" name="unit" required>
                        <option value="">Enhet</option>
                        <?php all_units(); ?>
                        </select><br>
                    </td>
                 </tr>
        </table>
        <h5>Status</h5>
            <select name="status" required>
                <option value="">Status</option>
                <option value='Aktiv'>Aktiv</option>
                <option value='Innaktiv'>Innaktiv</option>
            </select><br>
            <input type="submit" value="Lagre" name="submit"/>
        </div>
    </form>
    </div>
  
<?php
   


    if(isset($_POST["submit"])){
        
        $title = $_POST["title"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $unit = $_POST["unit"];
        $status = $_POST["status"];

        $sql = "SELECT * FROM products where commerceID='$userID' and title='$title';";
        $result = mysqli_query($db,$sql) or die ("Kan ikke hente fra databasen.");
        $num = mysqli_num_rows($result);

        if($num !=0){
            print("<br><p>Produktet er allerede registrert</p>");
        }
        else{
            $sql="INSERT INTO products (commerceID,title,description,price,unit,status) VALUES('$userID','$title','$description','$price','$unit','$status') ;";
            mysqli_query($db,$sql) or die ("Kan ikke registrere på databasen.");
            print("<p>Produktet er registrert</p>");
        }


    }
?>
</div>
