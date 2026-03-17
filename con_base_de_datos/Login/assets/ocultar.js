const mensaje = document.getElementById ("mensaje");
        if(mensaje){
        setTimeout(() => {
            mensaje.textContent = "";
            mensaje.style.display = "none";
        }, 5000);}