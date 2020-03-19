<?php 
include("control.php");
?>


<div class="dashboard_content">


    <div class="dashboardContainer">
    
        <div class="dashboard_info">
            Informasjon
        </div>
        
        <div class="dashboard_orders">
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

                print("<tr><td>$orderID</td> <td>$firstName $lastName</td> <td>$products</td> <td>$date</td><td>$status</td> <td><a href='/www/sda/reko/users/commerce/order/showOrder.php?orderID=$orderID'>Se ordre</a></td></tr>");
            }
            ?>
        </table>
        </div>
        
        <div class="dashboard_news">
            Nyheter
        </div>

    </div>






</div>



</body>
</html>