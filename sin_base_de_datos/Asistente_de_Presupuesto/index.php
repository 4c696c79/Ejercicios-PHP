<?php
session_start();
$mensaje = $_SESSION['mensaje'] ?? "";
$resultado = $_SESSION['resultado'] ?? null;
// limpiar para que no se repitan al refrescar
unset($_SESSION['mensaje'], $_SESSION['resultado']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistente de Presupuesto</title>
    <link rel="stylesheet" href="assest/style.css">
    <link rel="shortcut icon" href="assest/img/noFilter.png" type="image/x-icon">
</head>

<body>
    <header>
        Trabajo Mini Proyecto - Asistente de Presupuesto
    </header>
    <h1 style="text-align: center;">Calcular el presupuesto para la fiesta <br> Complete los datos</h1>
    <div class="contenedor">
        <form action="calculo.php" method="post" style="text-align: center;">
            <h3 for="disponible">Presupuesto disponible ($UYU)</h3><input type="number" name="disponible" placeholder="Ingresa un presupuesto" ><br>
            <div class="columna">
                <h3>Cantidad de adultos</h3><br>
                <h3>Costo por adulto ($UYU)</h3>
            </div>
            <div class="columna">
                <input type="number" name="cantidadAdultos" placeholder="Ingresa la cantidad de adultos" >
                <input type="number" name="costoAdulto" placeholder="Ingresa la costo * adulto" ><br>
            </div>
            <div class="columna">
                <h3>Cantidad de niños</h3><br>
                <h3>Costo por niño ($UYU)</h3>
            </div>
            <div class="columna">
                <input type="number" name="cantidadNinos" placeholder="Ingresa la cantidad de niños" >
                <input type="number" name="costoNino" placeholder="Ingresa la cantidad * niño" ><br>
            </div>
            <div class="checkboxes">
                <label for="dj"><strong>DJ($1500)</strong></label><input type="checkbox" name="adicional[]" value="1500" id="dj">
                <label for="bebidas"><strong>bebidas($600)</strong></label><input type="checkbox" name="adicional[]" value="600" id="bebidas">
                <label for="comida"><strong>comida($500)</strong></label><input type="checkbox" name="adicional[]" value="500" id="comida">
                <label for="seguridad"><strong>seguridad($800)</strong></label><input type="checkbox" name="adicional[]" value="800" id="seguridad">
                <label for="fotografo"><strong>fotografo($2000)</strong></label><input type="checkbox" name="adicional[]" value="2000" id="fotografo">
                <label for="otros"><strong>otros($500)</strong></label><input type="checkbox" name="adicional[]" value="500" id="otros">
            </div>
            <h3>Tipo de servicio</h3>
            <select name="menu">
                <option value="economico">Económico 🤑</option>
                <option value="estandar" selected>Estandar🤗</option>
                <option value="premium">Premium 11/10 😎</option>
            </select><br><br>

            <input type="submit" name="btm" value="Calcular">
        </form>
    </div>
<b></b>
    <?php if (!empty($mensaje)): ?>
        <div class="resultado"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <?php if (isset($resultado)): ?>
        <div class="resultado">
            <?php if ($resultado['suficiente']): ?>
                <strong>El presupuesto es suficiente ( •̀ ω •́ )✧</strong><br>
            <?php else: ?>
                <strong>El presupuesto no es suficiente.</strong><br>
            <?php endif; ?>
            Tu <strong>presupuesto</strong> es de $<?= $resultado['presupuesto'] ?><br>
            El costo <strong>promedio</strong> por persona es de $<?= $resultado['promedio'] ?><br>
            Cantidad de <strong>personas en total</strong> es <?= $resultado['invitados'] ?><br>
            El <strong>costo de invitado</strong> es $<?= $resultado['costoInvitados']; ?> ($<?= $resultado['totalAdultos']; ?> de adultos y $<?= $resultado['totalNinos']; ?> de niños)<br>
            el <strong>costo adicional</strong> es de $<?= $resultado['costoAdicional'] ?><br>
            <strong>Costo total:</strong> $<?= $resultado['costoTotal'] ?>
            <?php if ($resultado['suficiente']): ?>
                y te sobran $<?= $resultado['costoRestante'] ?> <br>
                <strong>Recomendación</strong>: <?= $resultado['recomendacion'] ?>
            <?php else: ?>
                y te faltan $<?= abs($resultado['costoRestante']) ?>
            <?php endif; ?><br>
        <?php endif; ?>
        </div>
        <footer>Trabajo hecho por Bruno Vázquez</footer>
</body>

</html>