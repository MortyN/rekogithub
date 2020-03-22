<?php
include("../control.php");
include("orderFunction.php");
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
        echo "<p><strong>Statusen er nå oppdatert</strong></p>";
        break;
    }  
    print("</div>");
}
?>
    <div class="prdOverview_container">
    <h2> Ordre nr: <?php print($orderID); ?> </h2>
        <p>Under er en oversikt over alle produkter som er bestilt av denne kunden. Det er viktig at du godkjenner eller <br>
        Kanselerer bestillingen slik at kunden er klar over om produktet kan hentes eller ikke.</p>
    </div>
    <div class="prdOverview_container">

        <table class="prdOverview">
            <tr>
                <th>Produkt</th>
                <th>Pris</th>
                <th>Mengde</th>
            </tr>

            <?php 
            $sql=   "SELECT products.title, products.price, users.email, products.unit, productsOrders.quantity, orders.status
            FROM products
            INNER JOIN productsOrders
            ON products.productID = productsOrders.productID
            INNER JOIN orders
            on productsOrders.orderID = orders.orderID
            INNER JOIN users
            ON orders.customerID = users.userID
            where orders.orderID = $orderID ;";

            $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
            $num = mysqli_num_rows($result);
            $part1=mysqli_fetch_array($result);
            $customerEmail = $part1["email"];

            for($i=1; $i<=$num; $i++){
                $part2=mysqli_fetch_array($result);

                $title = $part2["title"];
                $price = $part2["price"];
                $unit = $part2["unit"];
                $quantity= $part2["quantity"];
                $status = $part2["status"];
            
                print("<tr><td>$title</td> <td>$price $unit</td> <td>$quantity</td></tr>");
            }
            
            ?>
        </table>
        <form method="POST" action="">
        <select name ="status">
        <option value="">Status<option>
            <?php current_status($status); ?>
        </select>
        <input type="submit" name="submit" value="lagre"/>
        </form>
        <?php 
        
        if(isset($_POST["submit"])){

        $status1 = $_POST["status"];

        $sql2 = "UPDATE orders SET status = '$status1' WHERE orderID = '$orderID';";
        mysqli_query($db,$sql2) or ("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/commerce/order/showOrder.php?orderID=$orderID&error=sql'>") and die;
        
        switch ($status1){
            case "Bekreft":
                $yourOrder ="<table>";

                for($i=1; $i<=$num; $i++){
                    $part4=mysqli_fetch_array($result);
    
                    $title = $part4["title"];
                    $price = $part4["price"];
                    $unit = $part4["unit"];
                    $quantity= $part4["quantity"];
                    
                
                   $yourOrder = $yourOrder."<tr><td>$title</td> <td>$price $unit</td> <td>$quantity</td></tr>";
                
                }
                $yourOrder = $yourOrder."</table>";

                $mail->Subject = "$userFirstName $userLastName har bekreftet din ordre!";
                $mail->Body = "$yourOrder";
                $mail->AddAddress("hakonopheim@hotmail.com");
            break;
        }
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent";
        }
        $mail->ClearAddresses();



        print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/order/showOrder.php?orderID=$orderID&success=updateOK'/>");


        
        }
        ?>
    </div>
</div>
</div>