const link = document.getElementById('style');
const link98 = "../assest/css/98.css";
const linkaero = "../assest/css/aero.css";
let estilo = true;
function themes() {
    if (estilo) {
        link.href = link98;
    } else {
        link.href = linkaero;
    }

    estilo = !estilo;
}