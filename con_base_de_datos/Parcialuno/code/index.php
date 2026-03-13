<?php
include('linktodb.php');
$arrayInvitado = null; // el array asociativo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btm'])) {
    $nombre = trim($_POST['nombre']);
    $edad = intval($_POST['edad']);
    $invitado = $_POST['invitado'];

    $sql = "INSERT INTO invitados (nombre, edad, asistencia) VALUES (?, ?, ?)";
    $stmt = $link->prepare($sql); //prepara la consulta
    $stmt->bind_param("sis", $nombre, $edad, $invitado); //especifica los tipos

    if ($stmt->execute()) { //envia a la base de datos y lo guarda en un array
        $mensaje = "<div class = 'mensaje' id = 'mensaje'>Invitado agregado</div>";
        $arrayInvitado = [
            "nombre" => $nombre,
            "edad" => $edad,
            "asistencia" => $invitado
        ];
    }
    $stmt->close(); //cierra la sentencia
}
$mostrar = "SELECT id, nombre, edad, asistencia FROM invitados ORDER BY id ASC"; //muestra los datos en orden  ascendente, de menor a mayor 
$resultado = $link->query($mostrar); //devuelve el resultado de la consulta

$link->close();
?>
<!DOCTYPE html>
<!-- HTML -->
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiesta 2025</title>
    <link rel="shortcut icon" href="assets/img/Icon1.webp" type="image/x-icon">
    <link id="style" rel="stylesheet" href="assets/css/aero.css">
    <script src="changesThemes.js"></script>
</head>

<body>
    <div class="concuchara">
        <form action="#" method="post" class="formIngreso">
            <H2>Ingresar Invitado:</H2>
            <label for="nombre">Ingresar el nombre</label><br>
            <input type="text" name="nombre" id="nombre" placeholder="Juan Domingo" required>
            <br>
            <label for="edad">Ingresar edad</label><br>
            <input type="number" name="edad" placeholder="18 años" required>
            <br>
            <div class="asistencia">
                <label for="invitado">confirmación de assitencia</label><br>
                <label for="si">Sí</label><input type="radio" name="invitado" id="si" value="si" required>
                <label for="no">No</label><input type="radio" name="invitado" id="no" value="no">
            </div>

            <br>
            <button type="submit" class="btm" id="btm" name="btm">Subir</button>
            <?php if (isset($mensaje)) {
                echo $mensaje;
            } ?>
        </form>




        <div class="listaInvitados">
            <h2>Lista de Invitados 2025</h2>

            <input type="search" name="search" id="search" class="search">

            <?php if ($resultado->num_rows > 0): ?>
                <table id="tabla" class="tabla">
                    <thead>
                        <tr>
                            <th>Invitado</th>
                            <th>Edad(Años)</th>
                            <th>¿Asiste?</th>
                            <th>Editar</th>
                            <th>Borrar</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $fila['nombre']; ?> </td>
                                <td><?php echo $fila['edad']; ?></td>
                                <td><?php echo $fila['asistencia']; ?></td>
                                
                                <td><a href="edit.php?id=<?php echo $fila['id']; ?>"><img src="assets/img/pencil-3d-icon-download-in-png-blend-fbx-gltf-file-formats--pen-write-edit-writing-drawing-school-education-pack-icons-5012893.webp" alt=""></a></td>

                                <td><a href="remove.php?id=<?php echo $fila['id']; ?>"><img src="assets/img/Recycle_Bin_Empty.png" alt="trash"></a></td
                                    </tr>

                            <?php endwhile; ?>
                        <?php else: ?>
                            <h3 style="text-align: center;">No hay invitados registrado.</h3>
                        <?php endif; ?>
                    </tbody>
                </table>
        </div>

    </div>
    <footer>Trabajo hecho por Bruno Vázquez 3MC Informática <br>
        <button onclick="themes()" class="btmTema">Cambiar tema</button>

    </footer>
    <script src="filtro.js"></script> <!-- js del filtro de busqueda -->
    <script> //cambia el color del mensaje cada vez uque se envia el formulario
        const colores = ["red", "blue", "green", "orange", "purple"];
        const texto = document.getElementById("mensaje");
        const colorAleatorio = colores[Math.floor(Math.random() * colores.length)];// genera un numero entre 0 y 1 y lo multiplica * 5
        texto.style.color = colorAleatorio; //cambia el css del mensaje
    </script>
</body>

</html>