<?php
include('linktodb.php'); // Incluimos el archivo de conexión

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM invitados WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $id); // i: integer
    $stmt->execute();
    header("Location: index.php"); //te envia a la pagina una vez terminada la cnsulta
    $stmt->close();
} else {
    // Si no se proporciona un ID, redirigir a la página principal
    header("Location: index.php");
    exit(); // Es importante usar exit() después de header()
}

$link->close(); // Cerramos la conexión
