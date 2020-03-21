<?php
include("control.php");
?>

<div class="dashboard_content">
<div class="innerContainerPrdOverview">
<?php

if (isset($_GET['success'])) {
    print("<div class='messageBox'>");
    print("<div class='greenColorBox'></div>");

    $success = $_GET['success'];

    switch ($success)
    {
        case "deleteOK":
        echo "<p><strong>Ordren er nå slettet.</strong></p>";
        break;
    }  
    print("</div>");
}
?>
    <div class="prdOverview_container">
    <h2> Dine bestillinger</h2>
        <p>Under har du en oversikt over alle dine bestillinger. Dem er sortert etter dato bestillingen er foretatt- <br>
        Det er også her du må følge med etthvert som leverandører godkjenner dine ordre eller ikke<br>
        Dersom du ønsker å avbestille dine ordre kan du gjøre dette ved å klikke "se ordre" til høyre. Dette er kun mulig å gjøre<br>
        senest 5 dager før REKO samlingen. </p>
    </div>
    <div class="prdOverview_container">
        <table class="prdOverview">
            <tr>
                <th>Ordre nr.</th>
                <th>Leverandør</th>
                <th>Antall produkter</th>
                <th>Dato</th>
                <th>Status</th>
                <th>#</th> 
            </tr>

            <?php 
            $sql=   "SELECT orders.orderID, users.firstName, users.lastName, count(productsOrders.productID) AS products, orders.date, orders.status
                     FROM users
                     INNER JOIN orders
                     ON orders.commerceID = users.userID
                     INNER JOIN productsOrders
                     ON orders.orderID = productsOrders.orderID
                     WHERE orders.customerID = '$userID'
                     GROUP BY productsOrders.orderID;";

            $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");
            $num = mysqli_num_rows($result);

            for($i=1; $i<=$num; $i++){
                $part=mysqli_fetch_array($result);

                $orderID = $part["orderID"];
                $firstName = $part["firstName"];
                $lastName = $part["lastName"];
                $products= $part["products"];
                $date = $part["date"];
                $status = $part["status"];

                print("<tr><td>$orderID</td> <td>$firstName $lastName</td> <td>$products</td> <td>$date</td><td>$status</td> <td><a href='/www/sda/reko/users/moderator/showOrder.php?orderID=$orderID'>Se ordre</a></td></tr>");
            }
            ?>
        </table>
    </div>
</div>
</div>