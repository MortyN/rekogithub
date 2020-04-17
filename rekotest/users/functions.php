<?php
$host="localhost";
$user="hakonopheim";
$password="5k0th31a1";
$database="reko";

$db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");

    function delete_user($userID){
        $host="localhost";
        $user="hakonopheim";
        $password="5k0th31a1";
        $database="reko";

        $db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");
        $result = true;
        $sql = "SELECT orderID FROM orders where commerceID = $userID OR customerID = $userID;";
            $orders=mysqli_query($db,$sql) or ("<meta http-equiv='refresh' content='0;URL=http://reko.opheim.as/users/customer/profile/profile.php?error=delete'/>") and die;
            $xOrders = mysqli_num_rows($orders);
            
            
            
            for($k = 1 ; $k <= $xOrders ; $k++){
                $orderID_array=mysqli_fetch_array($orders);
                $orderID = $orderID_array['orderID'];

                $sql_delete_productsOrders = "DELETE FROM productsOrders WHERE orderID = $orderID;";
                if(!mysqli_query($db,$sql_delete_productsOrders)){
                    $result = false;
                }

            }

            $sql_delete_orders = "DELETE FROM orders WHERE commerceID = $userID OR customerID= $userID;";
            if(!mysqli_query($db,$sql_delete_orders)){
               $result = false;
           } 
            $sql_delete_products ="DELETE FROM products WHERE commerceID = $userID;";
            if(!mysqli_query($db,$sql_delete_products)){
                $result = false;
            }
            $sql_delete_post ="DELETE FROM post where userID = $userID;";
            if(!mysqli_query($db,$sql_delete_post)){
                $result = false;
            }
            $sql_delete_user ="DELETE FROM users WHERE userID = $userID;";
            if(!mysqli_query($db,$sql_delete_user)){
                $result = false;
            }
            return $result;
            

    }

    
          
?>