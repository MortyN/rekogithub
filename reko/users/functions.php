<?php

    function delete_user($userID){
        include("/www/sda/reko/db/connect.php");
        $result = true;
        $sql = "SELECT orderID FROM orders where commerceID = $userID OR customerID = $userID;";
            $orders=mysqli_query($db,$sql) or ("<meta http-equiv='refresh' content='0;URL=http://opheimpi.zapto.org/www/sda/reko/users/customer/profile/profile.php?error=delete'/>") and die;
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