<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/cssIndex.css">
    <link rel="shortcut icon" href="../assets/imgs/favico/marioWorld.png" type="image/x-icon">
</head>

<body>
    <?php include 'header.php' ?>
    <div class="cont">
    <h1>Hola <span style="color:brown"><?php echo $_SESSION['nombre'] ?></span>ヾ( •ω• )o</h1>
    <h1>Bienvenido/a a nuestra página web (｡･∀･)ﾉﾞ</h1>

    <a href="singup.php" class="welcomeA">¿Quiere registrarse con otra cuenta?</a>
    <a href="login.php" class="welcomeA">¿Quieres cambiar de sesion?</a>
    <a href="../backend/bd/logout.php" class="welcomeA">Cerrar sesión</a>
    </div>
</body>

</html>