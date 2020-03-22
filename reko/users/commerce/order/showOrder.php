<?php
include("../control.php");
include("orderFunction.php");
$orderID = $_GET["orderID"];
?>

<div class="dashboard_content">
<div class="innerContainerPrdOverview">
<?php
 print($userFirstName);
 print($userLastName);



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
        
            $sql01 = "SELECT users.email, orders.orderID
            from users
            INNER JOIN orders
            ON users.userID = orders.customerID
            where orders.orderID = $orderID;";
            
            $result01=mysqli_query($db,$sql01) or ("<meta http-equiv='refresh' content='0;url=http://opheimpi.zapto.org/www/sda/reko/users/commerce/order/showOrder.php?orderID=$orderID&error=sql'>") and die;
            $part01 = mysqli_fetch_array($result01);
            $customerEmail = $part01["email"];

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP(); // enable SMTP

            $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "reko.opheim.as";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "noreply@reko.opheim.as";
            $mail->Password = "rekodev69";
            $mail->SetFrom("noreply@reko.opheim.as");
           


        switch ($status1){
            case "Bekreftet":
                $mail->Subject = $userFirstName." ".$userLastName." har bekreftet orderen din!";
                $mail->Body = "<strong>Testmail</strong>";
                $mail->Altbody = "Ren tekst";
                $mail->AddAddress("hakonopheim@hotmail.com"); 
            break;

            case "Kanselert":
                $mail->Subject = $userFirstName." ".$userLastName." har kanselert orderen din!";
                $mail->Body = "<strong>Testmail</strong>";
                $mail->Altbody = "Ren tekst";
                $mail->AddAddress("hakonopheim@hotmail.com"); 
            break;
        }   

        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
         } else {
            echo "Message has been sent";
         }
         $mail->ClearAddresses();

        //print("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/commerce/order/showOrder.php?orderID=$orderID&success=updateOK'/>");
        
        }
        ?>
    </div>
</div>
</div>