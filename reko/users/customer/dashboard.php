<?php 
include("control.php");

?>

<div class="dashboard_content">


    <div class="dashboardContainer">
    
        <div class="dashboard_info">
           <h3> Velkommen til din kundeprofil</h3>
           <p> På denne siden vil du ved å navigere deg rundt i menyen til venstre, få muligheten til å se hvilkene varer du har bestilt til neste REKO ring. <br>
            Her inne kan du også redigere informasjon om profilen din. </p>
        </div>
        
        <div class="dashboard_orders">
        <h3>Dine 5 siste bestillinger:</h3>
        <table class="prdOverview">
            <tr>
                <th>Ordre nr.</th>
                <th>Leverandør</th>
                <th>Dato</th>
                <th>Status</th>
            </tr>

            <?php 
            $sql=   "SELECT orders.orderID, users.firstName, users.lastName, count(productsOrders.productID) AS products, orders.date, orders.status
                     FROM users
                     INNER JOIN orders
                     ON orders.commerceID = users.userID
                     INNER JOIN productsOrders
                     ON orders.orderID = productsOrders.orderID
                     WHERE orders.customerID = '$userID'
                     GROUP BY productsOrders.orderID
                     ORDER BY orders.date DESC, orders.orderID DESC
                     LIMIT 5;";


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

                print("<tr><td>$orderID</td> <td>$firstName $lastName</td> <td>$date</td><td>$status</td></tr>");
            }
            ?>
        </table>
        </br>
        <a href=/users/customer/profile/orders.php><button class="dashboardBTN">Se alle</button></a>
        </div>
        
       
        
        <div class="dashboard_news">
           <h3> Nyheter </h3>
            <?php
            $sql = "SELECT * FROM news;";

            $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");

            $part=mysqli_fetch_array($result);

                $news = $part["news"];
                $date = $part["date"];
                
                
                print("<p>$news</p>");
                ?>
            


        </div>

    </div>






</div>
</div>
