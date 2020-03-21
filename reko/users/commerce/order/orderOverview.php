<?php
include("../control.php");
?>

<div class="dashboard_content">
<div class="innerContainerPrdOverview">
    <div class="prdOverview_container">
    <h2> Motatt bestillinger</h2>
        <p>Under er en oversikt over alle bestillinger som er knyttet til deg som leverandør, du kan klikke på "Se ordre" <br>
        for å se hvilken produkter orderen inneholder og eventuelt bekrefte orderen.</p>
    </div>
    <div class="prdOverview_container">
        <table class="prdOverview">
            <tr>
                <th>Ordre nr.</th>
                <th>Kunde</th>
                <th>Antall produkter</th>
                <th>Dato</th>
                <th>Status</th>
                <th>#</th> 
            </tr>

            <?php 
            $sql=   "SELECT orders.orderID, users.firstName, users.lastName, count(productsOrders.productID) as products,orders.date,orders.status
                    from users
                    INNER JOIN orders
                    on orders.customerID = users.userID
                    INNER JOIN productsOrders
                    on orders.orderID = productsOrders.orderID
                    WHERE orders.commerceID = '$userID'
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

                switch ($status){
                    case "Bekreftet":
                        $color = "green";
                    break;
                    case "Venter":
                        $color = "orange";
                    break;
                    case "Kanselert":
                        $color = "red";
                    break;

                }

                

<<<<<<< HEAD:var/www/html/www/sda/reko/users/commerce/order/orderOverview.php
                print("<tr><td>$orderID</td> <td>$firstName $lastName</td> <td>$products</td> <td>$date</td><td style='color:$color;'>$status</td> <td><a href='/www/sda/reko/users/commerce/order/showOrder.php?orderID=$orderID'>Se ordre</a></td></tr>");
=======
                print("<tr><td>$orderID</td> <td>$firstName $lastName</td> <td>$products</td> <td>$date</td><td style='color:$color;'>$status</td> <td><a href='/users/commerce/order/showOrder.php?orderID=$orderID'>Se ordre</a></td></tr>");
>>>>>>> c9be52895f1975e540d539d881681786a1e3fdd2:reko/users/commerce/order/orderOverview.php
            }
            ?>
        </table>
    </div>
</div>
</div>