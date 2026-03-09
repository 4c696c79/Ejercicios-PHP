<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/cssFormulario.css">
    <link rel="shortcut icon" href="../assets/imgs/favico/MK8_Yoshi_Icon.png" type="image/x-icon">
</head>

<body>
    <?php include 'header.php' ?>
    <form action="../backend/Registrarse.php" method="post" class="formulario">
    <h2>Complete los campos para <span style="color:red">Crear una cuenta</span></h2>
        <h3>Nombre</h3> <input type="text" name="nombre" id="nombre" placeholder="EJ:Juanito">
        <h3>Correo</h3> <input type="email" name="email" id="email" placeholder="EJ:juan@example.com">
        <h3>Contraseña</h3> <input type="password" name="contraseña" id="contraseña" placeholder="EJ:JuanitoContraseña"><br>
        <button type="submit" name="btnRegistrarse">Registrarse §(*￣▽￣*)§</button><br>
    <a href="index.php">Volver al Index</a>

        <?php 
        if (!empty($_SESSION['mensaje'])) {
            echo "<h2 id='mensaje'>".$_SESSION['mensaje']."</h2>";
            unset($_SESSION['mensaje']);
        } ?>
    </form>
    <script src="../assest/ocultar.js"></script>
</body>

</html>