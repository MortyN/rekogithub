<?php include("meny.php"); ?>


<div class="overview_info">
<h1>Ofte stilte spørsmål</h1>
<p>Under finner du ofte stilte spørsmål og svar, kanskje du finner svar på det du lurer på</p> <br /> <br />

<div class=nycount>
<button class="accordion"><h2>Hvordan vet jeg hva jeg har bestilt?</h2></button>

<div class="panel">
<p>Dine bestillinger blir automatisk samlet sammen og sendt som èn ordre til din e-post. På denne måten blir det enkelt å se hva man har bestilt, og hvem man har bestilt fra</p> <br />
</div>

<button class="accordion"><h2>Hvor betaler jeg?</h2></button>
<div class="panel">
<p>All betaling foregår direkte mellom deg og din leverandør når du henter din bestilling.</p>
</div>

<button class="accordion"><h2>Hvor henter jeg det jeg har bestilt?</h2></button>
<div class="panel">
<p>Hver andre uke samles kunder og leverandører i kjelleren til Per og koser seg.</p>
</div>

</div>

</div>


<style>
.panel {
  padding: 0 18px;
  background-color: whitesmoke;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
</style>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
</script>
<?php include("footer1.php"); ?>