<?php
require '../backend/bd/conexion.php';
$confirmacion = false;
session_start();
$_SESSION['mensaje'] = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnRegistrarse'])) {

    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['email'] ?? '');
    $contraseña = trim($_POST['contraseña'] ?? '');

    if (empty($nombre) || empty($correo) || empty($contraseña)) {
        $_SESSION['mensaje'] = "Necesitas completar todos los campos para registrarte";
    } else { #Verifica si ya existe el usuario

        $sqlSELECT = "SELECT id FROM usuarios WHERE email = ?";
        $stmtSELECT = $conn->prepare($sqlSELECT);
        $stmtSELECT->bind_param("s", $correo);
        $stmtSELECT->execute();
        $resultadoSELECT = $stmtSELECT->get_result();

        if ($resultadoSELECT->num_rows > 0) {
            $mensaje = "Este usuario ya existe, inicie sesión";
        } else { #Crea el usuario

            #Hashea la contraseña
            $contraHasheada = password_hash($contraseña, PASSWORD_DEFAULT);
            $sqlINSERT = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
            $stmtINSERT = $conn->prepare($sqlINSERT);
            $stmtINSERT->bind_param("sss", $nombre, $correo, $contraHasheada);

            if ($stmtINSERT->execute()) {
                $_SESSION['mensaje'] = "Ya estas Registado d=(￣▽￣*), ahora puedes iniciar sesión";
                $confirmacion = true;
            } else {
                $_SESSION['mensaje'] = "Error en el execute" . $stmtINSERT->error;
            }
            $stmtINSERT->close();
        }
        $stmtSELECT->close();
    }
}
if ($confirmacion) {
   header('location:../frontend/index.php');
}else{
    header('location:../frontend/singup.php');
}
$conn->close();
exit;
?>
