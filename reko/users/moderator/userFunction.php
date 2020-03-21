<?php


function selectedRole($role)
{

   // moderator --> Moderator
   // commerce  --> Leverandør 
   // customer  --> Kunde

   if ($role == "moderator") {
       print ("<option value='moderator' selected>Moderator</option>");
       print ("<option value='commerce'>Leverandør</option>");
       print ("<option value='customer'>Kunde</option>");
   }
   elseif ($role == "commerce") {
    print ("<option value='moderator'>Moderator</option>");
    print ("<option value='commerce' selected>Leverandør</option>");
    print ("<option value='customer'>Kunde</option>");
   }
   elseif ($role == "customer") {
    print ("<option value='moderator'>Moderator</option>");
    print ("<option value='commerce'>Leverandør</option>");
    print ("<option value='customer' selected>Kunde</option>");
   }



}

function status($status)
{
   // 1 --> Aktiv
   // 0 --> Inaktiv

   if ($status == "0") {
    print ("<option value='0' selected>Inaktiv</option>");
    print ("<option value='1'>Aktiv</option>");
   }
   elseif ($status == "1") {
    print ("<option value='1' selected>Aktiv</option>");
    print ("<option value='0'>Inaktiv</option>");
   }


}
