<?php 



function current_status($status){
    

        switch ($status){
            case 'Aktiv':
                print("<option value='Aktiv' selected>Aktiv</option>");
                print("<option value='Innaktiv'>Innaktiv</option>");
            break;
            
            case 'Innaktiv':
                print("<option value='Aktiv' >Aktiv</option>");
                print("<option value='Innaktiv' selected>Innaktiv</option>");
            break;
        }
        
        



    


}

?>