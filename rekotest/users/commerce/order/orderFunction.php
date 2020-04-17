<?php
function current_status($status){
    

    switch ($status){
        case 'Bekreftet':
            print("<option value='Bekreftet' selected>Bekreftet</option>");
            print("<option value='Kanselert'>Kanselert</option>");
            print("<option value='Venter'>Venter</option>");
        break;
        
        case 'Kanselert':
            print("<option value='Bekreftet'>Bekreftet</option>");
            print("<option value='Kanselert' selected>Kanselert</option>");
            print("<option value='Venter'>Venter</option>");
        break;
        case 'Venter':
            print("<option value='Bekreftet' >Bekreftet</option>");
            print("<option value='Kanselert'>Kanselert</option>");
            print("<option value='Venter' selected>Venter</option>");
    }
    
    






}
?>