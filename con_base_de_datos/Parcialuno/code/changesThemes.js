const link = document.getElementById('style');
const link98 = "assets/css/98.css";
const linkaero = "assets/css/aero.css";
let estilo = true;
function themes() {
    if (estilo) {
        link.href = link98;
    } else {
        link.href = linkaero;
    }

    estilo = !estilo;
}