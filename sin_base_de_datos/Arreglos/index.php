<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arreglo</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.jpg" type="image/x-icon">

</head>

<body>
    <header>
        <a href="https://www.youtube.com/watch?v=PnFCwL8NlXs&list=RDPnFCwL8NlXs&start_radio=1&pp=ygUPbXVzaWNhIGRlIHNocmVroAcB" target="_blank" rel="noopener noreferrer">Trabajo hecho por Shrek el Ogro (o′┏▽┓｀o)</a>
    </header>

    <div class="uno">
        <div class="nombre">
        <h1>Ejercicio 1</h1>
        <p>Crea un arreglo indexado llamado <span>$colores con 4 colores</span>. Mostralos en una lista HTML usando foreach</p></div>
        <?php
        $coloresEspañol = ['Azul', 'Rojo', 'Verde', 'Naranja'];
        $coloresEnglish = ['blue', 'red', 'green', 'orange'];
        foreach ($coloresEspañol as $num => $color) {
            echo "
            <ul>
            <li style = 'color:$coloresEnglish[$num]; list-style-type:none'>$color</li>
            </ul>
            ";
        }

        ?>
    </div>
    <div class="dos">
        <div class="nombre"><h1>Ejercicio 2 </h1>
        <p>Crea un arreglo asociativo llamado <span>$estudiante con nombre, edad y curso.</span> Mostralo como una tabla HTML.</p></div>
        <?php
        $estudiante =
            [
                "nombre" => "Guadalupe",
                "edad" => 28,
                "curso" => "Gastronomia"
            ];
        ?>
        <table>
            <tr>
                <th><strong>Nombre</strong></th>
                <th><strong>Edad</strong></th>
                <th><strong>Curso</strong></th>
            </tr>
            <tr>
                <td><?php echo $estudiante['nombre']; ?></td>
                <td><?php echo $estudiante['edad']; ?></td>
                <td><?php echo $estudiante['curso']; ?></td>
            </tr>


        </table>

    </div>
</body>

</html>