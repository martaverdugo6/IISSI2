function myToggleMenu() {

    var x = document.getElementById("idMenu");

    if (x.className === "menu") {

        x.className += " responsive";

    } else {

        x.className = "menu";

    }

}