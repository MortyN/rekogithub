<?php 
include("control.php");

?>

<div class="dashboard_content">


    <div class="dashboardContainer">
    
        <div class="dashboard_info">
            <h3>Velkommen til Moderator Kontrollpanel </h3>
            <p> Her har du mulighet til å adminstrere og kontrollerer alle brukere som er registrert i denne ringen.
            <p> Det er også her du skal opprette leverandør brukere. <p>
            <p> I tillegg til å være moderator, skal du selvfølgelig også få lov til å bestille vare fra vår flotte leverandører <br>
            Oversikten over varene du har bestilt finner du på Dine ordre i menyen til venstre.</p>
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
        <a href=/users/moderator/orders.php><button class="dashboardBTN">Se alle</button></a>
        </div>
        
        
        
        <div class="dashboard_news">
           <h3> Nyheter </h3>
           
                    <?php
                    $sql = "SELECT * FROM news;";

                    $result = mysqli_query($db,$sql) or die("Kan ikke hente produkter akkurat nå.");

                    $part=mysqli_fetch_array($result);

                        $news = $part["news"];
                        $date = $part["date"];
                    ?>
        <form action="" method="post" class="editNews">
            <textarea class="modNews" name="news"> <?php print("$news");?> </textarea></br>
            <input class="leggUt" type="submit" name="submit" value="Legg Ut">
            </form>
            <?php 
        
                if (isset($_POST['submit'])) {
                    $newNews = $_POST['news'];
                    
                
                $sql = "UPDATE news SET news = '$newNews' WHERE news ='$news';";
                mysqli_query($db,$sql) or die("Kan ikke laste opp.");
                print("<meta http-equiv='refresh' content='0;url=http://reko.opheim.as/users/moderator/dashboard.php'>");
                }

            ?>

             
        </div>
        <div class="dashboard_feedReset">
            <h3>Nullstill annonser</h3>
                <p>Etter hver REKO-ring anbefaler vi å nullstille annonse oversikten. 
                    Ved å trykke på denne knappen, blir alle innleggene fra samtlige leverandører fjernet fra oversikten.
                    Dette er lurt å gjøre etter hver REKO-samling, for å unngå at leverandører har publiserte annonser som ikke lenger er relevante.
                    Etter du har trykket på knappen under, må leverandørene selv logge inn på deres profilside for å endre og aktivere innlegget sitt igjen. 
                 </p>
                 <form action="" method="post" class="editNews">
                 <input id="NullstillAnn" type="submit" name="resetFeed" value="Nullstill Annonser">
            </form>

            <?php 
            if(isset($_POST['resetFeed'])){
                
                $sql = "UPDATE post SET category = 'Innaktiv' WHERE category = 'Aktiv';";
                mysqli_query($db,$sql) or die ("Kan ikke nullstille annonser");
            

                $sql2 = "UPDATE orders SET status = 'Arkivert' WHERE status != 'Arkivert';";
                mysqli_query($db,$sql2) or die ("Kan ikke nullstille annonser");
                print("Annonsene er nå innaktive.");



            }

?>
        </div>

    </div>






</div>
