<?php
include('linktodb.php'); // se vincula con la BD

$invita = null; //array

//Para tener los datos del invitado seleccionado en base a su id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select_one = "SELECT id, nombre, edad, asistencia FROM invitados WHERE id = ?";
    $stmt = $link->prepare($sql_select_one);//prepara la cosulta
    $stmt->bind_param("i", $id);//pone el tipo de id en la bd
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $invita = $resultado->fetch_assoc();
    }
    $stmt->close();
}

// --- Lógica para ACTUALIZAR el invita$invita (UPDATE) ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizarInvitado'])) {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $edad = intval($_POST['edad']);
    $invitado = $_POST['invitado'];

    if (!empty($nombre) && !empty($edad) && !empty($invitado)) {
        $sql_update = "UPDATE invitados SET nombre = ?, edad = ?, asistencia = ? WHERE id = ?";
        $stmt = $link->prepare($sql_update);
        $stmt->bind_param("sisi", $nombre, $edad, $invitado, $id);
        
        if ($stmt->execute()) {
            $mensaje = "<div class = 'mensaje' id= 'mensaje'>Se ha actualizado correctamente los datos</div>";
            // Actualizar los datos del invita$invita en la página después de la edición
            $invita = [
                "id" => $id,
                "nombre" => $nombre,
                "edad" => $edad,
                "asistencia" => $invitado
                        ];
        }
        $stmt->close();
    }
}

// Si no hay ID en la URL o el invitado no fue encontrado, envia al index
if (!$invita && !isset($_POST['actualizarInvitado'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar invitado</title>
    <link rel="shortcut icon" href="assets/img/Icon1.webp" type="image/x-icon">
    <link id="style" rel="stylesheet" href="assets/css/aero.css">
    <script src="changesThemes.js">console.log("HOLA");</script>
</head>

<body>
    <div class="concuchara">
        <?php if ($invita): ?>
            <form action="#" method="POST" class="formIngreso">
                <h1>Editar invitado</h1>
                <input type="hidden" name="id" value="<?php echo $invita['id']; ?>">

                <label for="nombre">Nombre</label><br>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($invita['nombre']); ?>" required><br>

                <label for="edad">Edad</label><br>
                <input type="number" id="edad" name="edad" value="<?php echo $invita['edad']; ?>" required>

                <label>Confirmación de asistencia:</label><br>
                <label for="si">Sí</label>
                <input type="radio" name="invitado" id="si" value="si" <?php if ($invita['asistencia'] == 'si') echo 'checked'; ?> required>
                <label for="no">No</label>
                <input type="radio" name="invitado" id="no" value="no" <?php if ($invita['asistencia'] == 'no') echo 'checked'; ?>>


                <br><button type="submit" class="btm" name="actualizarInvitado">Actualizar</button>
                <a href="index.php" class="btm" style="display: inline-block;">Volver</a>
                <button onclick="themes()" class="btmTema">Cambiar tema</button>
                <?php if(isset($mensaje)){ echo $mensaje;} ?>
            </form>
        <?php else: ?>
            <p>No se encontró el invitado para editar.</p>
            <a href="index.php" class="back-link">Volver al Listado</a>
        <?php endif; ?>
    </div>
        <script>
  const colores = ["red", "blue", "green", "orange", "purple"];
  const texto = document.getElementById("mensaje");
  const colorAleatorio = colores[Math.floor(Math.random() * colores.length)];
  texto.style.color = colorAleatorio;
</script>
</body>

</html>

<?php
$link->close(); // Cerramos la conexión
?>