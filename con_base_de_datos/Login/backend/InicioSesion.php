<?php
session_start();
require('bd/conexion.php');
$_SESSION['mensaje'] = NULL;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn'])) {
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['contraseña'])) {
        $_SESSION['mensaje'] = "Complete todo los campos Para iniciar sesión";
    } else {
        $usuario = NULL;
        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $contraseña = trim($_POST['contraseña'] ?? '');

        $sql = "SELECT * FROM usuarios WHERE nombre = ? AND email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $email);
        $stmt->execute();
        $mostrar = $stmt->get_result();
        if ($mostrar->num_rows > 0) {
            $usuario = $mostrar->fetch_assoc();
            if (password_verify($contraseña, $usuario['password'])) {
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                header('location:../frontend/welcome.php');
                exit;
            } else {
                $_SESSION['mensaje'] = "contraseña incorrecta";
            }
        } else {
            $_SESSION['mensaje'] = "Campo incorrecto o desconocido";
        }
        $stmt->close();
    }
}
$conn->close();
header('location: ../frontend/login.php');
exit;
