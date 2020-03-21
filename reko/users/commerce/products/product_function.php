<?php


function all_units(){
    $host="localhost";
    $user="hakonopheim";
    $password="5k0th31a1";
    $database="reko";

    $db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");
    
    $sql = "SELECT * FROM units;";
    $result = mysqli_query($db,$sql) or die ("N/A");
    $i = mysqli_num_rows($result);

    for($c=0; $k <= $i ; $k++){
        $part = mysqli_fetch_array($result);

        $unit = $part["name"];

        print("<option value='$unit'> $unit </option>");

    }
    


}

function selectedUnit($selectedUnit){
    $host="localhost";
    $user="hakonopheim";
    $password="5k0th31a1";
    $database="reko";

    $db=mysqli_connect($host,$user,$password,$database) or die ("ikke kontakt med database-server");
    
    $sql = "SELECT * FROM units;";
    $result = mysqli_query($db,$sql) or die ("N/A");
    $i = mysqli_num_rows($result);

    for($c=0; $k <= $i ; $k++){
        $part = mysqli_fetch_array($result);

        $unit = $part["name"];
        if($unit == $selectedUnit){
            print("<option value='$unit' selected> $unit </option>");
        }
        else{
            print("<option value='$unit'> $unit </option>");
        }

        

    }
    


}

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