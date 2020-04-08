<?php include("meny.php"); ?>


<div class="overview_info">
<h1>Ofte stilte spørsmål</h1>
<p>Under finner du ofte stilte spørsmål og svar, kanskje du finner svar på det du lurer på</p> <br /> <br />

<h1>Ofte stilte spørsmål</h1>
<p>Under finner du ofte stilte spørsmål og svar, kanskje du finner svar på det du lurer på</p>
  
<button onclick="myFunction('1')" class="question">
<h2>Hvordan vet jeg hva jeg har bestilt?</h2>
</button>
<div id="1" class="w3-container w3-hide qContent">
  <p>Dine bestillinger blir automatisk samlet sammen og sendt som èn ordre til din e-post. På denne måten blir det enkelt å se hva man har bestilt, og hvem man har bestilt fra</p>
</div>

<button onclick="myFunction('2')" class="question">
<h2>Hvor betaler jeg?</h2>
</button>
<div id="2" class="w3-container w3-hide qContent">
 <p>All betaling foregår direkte mellom deg og din leverandør når du henter din bestilling.</p>
</div>

<button onclick="myFunction('3')" class="question">
<h2>Hvor henter jeg det jeg har bestilt?</h2>
</button>
<div id="3" class="w3-container w3-hide qContent">
<p>Hver andre uke samles kunder og leverandører i kjelleren til Per og koser seg.</p>
</div>

</div>


<script>
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
<?php include("footer1.php"); ?>