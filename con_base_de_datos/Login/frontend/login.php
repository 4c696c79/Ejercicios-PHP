<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesión</title>
    <link rel="stylesheet" href="../assets/css/cssFormulario.css">
    <link rel="shortcut icon" href="../assets/imgs/favico/toad.jpeg" type="image/x-icon">
</head>

<body>
    <?php include 'header.php' ?>
    <form action="../backend/InicioSesion.php" method="post" class="formulario">
        
        <h1>Inicio sesión</h1>

        <h3>Ingrese su <span style="color:red">Nombre</span></h3><input type="text" name="nombre" id="nombre" placeholder="Su nombre"><br>
        <h3>Ingrese su <span style="color:blue">Email</span></h3><input type="email" name="email" id="email" placeholder="Su correo"><br>
        <h3>Ingrese su <span style="color:orange">Contraseña</span></h3><input type="password" name="contraseña" id="contraseña" placeholder="Su constraseña"><br>
        <button type="submit" name="btn">Iniciar sesión (*￣;(￣ *) </button><br>
        <?php if (isset($_SESSION['mensaje']) && !empty($_SESSION['mensaje'])):
            echo "<h2 id='mensaje'>".$_SESSION['mensaje']."</h2>";
        endif?>
    <a href="index.php">Volver al Index</a>
    </form>
    <script src="../assets/ocultar.js"></script>
</body>

</html>