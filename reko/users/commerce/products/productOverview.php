<?php
include("../control.php");
?>
<div class="dashboard_content">
<div class="innerContainerPrdOverview"> 
    <div class="prdOverview_container">
        <p>Under er en oversikt over alle dine registrerte produkter, du kan klikke på "rediger" for å endre produkt eller status
        på produktet. </p>
    </div>
    <div class="prdOverview_container">
        <table class="prdOverview">
            <tr>
                <th>Navn på produkt</th>
                <th>Beskrivelse</th>
                <th>Pris</th>
                <th>Enhet</th>
                <th>Status</th>
                <th>#</th> 
            </tr>
            <?php 
            $sql="SELECT * FROM products WHERE commerceID='$userID';";
            $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
            $num = mysqli_num_rows($result);

            for($i=1; $i<=$num; $i++){
                $part=mysqli_fetch_array($result);

                $name = $part["title"];
                $description = $part["description"];
                $price = $part["price"];
                $unit= $part["unit"];
                $status = $part["status"];
                $productID = $part["productID"];

                print("<tr><td>$name</td> <td>$description</td> <td>$price</td> <td>$unit</td> <td>$status</td> <td><a href='/users/commerce/products/editProduct.php?prdID=$productID'>Rediger</a></td></tr>");
            }
            ?>
        </table>
    </div>
</div>
</div>