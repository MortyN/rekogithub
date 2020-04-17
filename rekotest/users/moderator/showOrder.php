<?php
include("control.php");

$orderID = $_GET["orderID"];
?>

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
        echo "<p><strong>Kan ikke slette ordre </strong></p>";
    break;

    }
  print("</div>");
}
?>
    <div class="prdOverview_container">
    <h2> Ordre nr: <?php print($orderID); ?> </h2>
        <p>Under er en oversikt over alle produkter som du har bestilt av denne leverandøren.<br> Det er ikke mulig å endre produkter,
        Så dersom du ønsker å endre et produkt, så må du slette bestillingen, for så å legge til en ny.</p>
    </div>
    <div class="prdOverview_container">
        <table class="prdOverview">
            <tr>
                <th>Produkt</th>
                <th>Pris</th>
                <th>Mengde</th>
            </tr>

            <?php 
            $sql=   "SELECT products.title, products.price, products.unit, productsOrders.quantity, orders.status
            FROM products
            INNER JOIN productsOrders
            ON products.productID = productsOrders.productID
            INNER JOIN orders
            on productsOrders.orderID = orders.orderID
            where orders.orderID = $orderID;";

            $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
            $num = mysqli_num_rows($result);

            for($i=1; $i<=$num; $i++){
                $part=mysqli_fetch_array($result);

                $title = $part["title"];
                $price = $part["price"];
                $unit = $part["unit"];
                $quantity= $part["quantity"];
                $status = $part["status"];
                

                print("<tr><td>$title</td> <td>$price $unit</td> <td>$quantity</td></tr>");
            }
            
            ?>
        </table>
        <form method="POST" action="">
        <input type="submit" name="submit" value="Slett ordre"/>
        </form>
        <?php 
        if(isset($_POST["submit"])){

            $sql1="DELETE FROM productsOrders where orderID=$orderID;";
            $result1=mysqli_query($db,$sql1) or ("<meta http-equiv='refresh' content='0;URL=http://reko.opheim.as/users/moderator/showOrder.php?error=sql&orderID=$orderID'/>") and die;
            $sql2= "DELETE FROM orders WHERE orderID = $orderID;";
            $result2=mysqli_query($db,$sql2) or ("<meta http-equiv='refresh' content='0;URL=http://reko.opheim.as/users/moderator/showOrder.php?error=sql&orderID=$orderID'/>") and die;

            if($result1 && $result2){
                print("<meta http-equiv='refresh' content='0;URL=http://reko.opheim.as/users/moderator/orders.php?success=deleteOK'/>");
            }
    
        }
        ?>
    </div>
</div>
</div>