<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.mobile-container {
  max-width: 100%;
  margin: auto;
  background-color: white;
  height: 500px;
  color: white;
  border-radius: 10px;
}

.mobileNav {
  overflow: hidden;
  background-color: #333;
  position: relative;
}

.topnav #mobileNavLinks {
  display: none;
}

.mobileNav a {
  color: white;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 30px;
  display: block;
  text-align:center;
}

.mobileNav a.icon {
  background: black;
  display: block;
  height: 6vh;
  width:6vw;
  position: absolute;
  right: 0;
  top: 0;
  font-size:4vh;
  text-align:center;
  
}
img{
    width: 5vh;
    float: left;
    position: relative;
    top: 0.4vw;
   
    
    }

.mobileNav a:hover {
  background-color: #598B35;
  color: black;
}

.active {
  background-color: #655C56;
  color: white;
  height:6vh;
}
</style>
</head>
<body>

<!-- Simulate a smartphone / tablet -->
<div class="mobile-container">

<!-- Top Navigation Menu -->
<div class="mobileNav">
  <a href="#home" class="active"><img src="http://opheimpi.zapto.org/www/sda/reko/img/rekologo.png"/></a>
  <div id="mobileNavLinks">
    <a href="#news">Anonnser</a>
    <a href="#contact">Leverandører</a>
    <a href="#about">Kontakter</a>
     <a href="#news">Hjelp</a><br>
    <a href="#contact">Logg inn</a>
    <a href="#about">Registrer deg</a>
  </div>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<div style="padding-left:16px">
  <h3>Vertical Mobile Navbar</h3>
  <p>This example demonstrates how a navigation menu on a mobile/smart phone could look like.</p>
  <p>Click on the hamburger menu (three bars) in the top right corner, to toggle the menu.</p>
</div>

<!-- End smartphone / tablet look -->
</div>

<script>
function myFunction() {
  var x = document.getElementById("mobileNavLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>