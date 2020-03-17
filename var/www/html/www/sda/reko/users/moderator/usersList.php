<?php
include("control.php");
?>

<div class="dashboard_content">
<div class="innerContainerPrdOverview">
    <div class="prdOverview_container">
        <p>Under ser du en oversikt over alle brukere som er i denne reko ringen. Bruk søkefeltet for raskere navigering. </p>
    </div>
    <div class="prdOverview_container">

        <script src ="ajax.js"></script>
        <div class="form">
            <form method="POST" action="">
                <h3> Her kan du søke etter brukere</h3>

                <p><a>Søkeord</a></p>
                <input type="text" id="search" name="search" onKeyUp="show(this.value)" placeholder="Søkeord"/>
                


                <div id="resultSearch">
                
                  </div>

        </form>
    </div>

</div>
    
</div>