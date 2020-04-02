function navBar() {
    var x = document.getElementById("mainNav");
    if (x.className === "mainNav") {
        x.className += " responsive";
    } else {
        x.className = "mainNav";
    }
}