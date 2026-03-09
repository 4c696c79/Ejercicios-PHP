
    //crear variables en base a las id. la filas son en base a l el tr de la tabla
    const search = document.getElementById('search');
    const table = document.getElementById('tabla');
    const filas = table.getElementsByTagName('tr');

    search.addEventListener('keyup', function () {//interactua cuando el user esta escribiendo o borrando en el input search
        const filtro = search.value.toLowerCase();//convierte lo escrito en minuscuas

        for (let i = 1; i < filas.length; i++) { // i=1 para saltar el encabezado
            const fila = filas[i];
            const cells = fila.getElementsByTagName('td'); // divide las filas 
            let visible = false;//hace para que se vea o no

            for (let j = 0; j < cells.length - 2; j++) { // Ignora las columnas editar/borrar
                if (cells[j].textContent.toLowerCase().includes(filtro)) {
                    //Si el texto de alguna celda (convertido a minúsculas) contiene lo que escribió el usuario, se marca la fila como visible y se corta el bucle.
                    visible = true; // se activa
                    break; // se rompe el buble for[j]
                }
            }

            fila.style.display = visible ? '' : 'none';
            //si es true el visible, muestrae el resultado.
        }
    });

