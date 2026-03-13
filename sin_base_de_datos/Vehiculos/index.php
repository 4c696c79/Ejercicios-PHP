<?php
//Ejercicio PHP para crear una lista de vehiculos (auto, moto o camioneta)
//Se llama a las distintas clases auto
require_once 'clases/Auto.php';
require_once 'clases/Moto.php';
require_once 'clases/Camion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['listaVehiculos']) || !is_array($_SESSION['listaVehiculos'])) {
    $_SESSION['listaVehiculos'] = [];
}

//Cuando se presiona el btn de eliminar auto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnEliminar'])) {
    $index = $_POST['eliminar'] ?? null;
    if ($index !== null && isset($_SESSION['listaVehiculos'][$index])) { // en el isset toma la posicion del auto que se tomó de la listaVehiculos
        unset($_SESSION['listaVehiculos'][$index]);
        $_SESSION['listaVehiculos'] = array_values($_SESSION['listaVehiculos']); // reindexa
    }
    header("Location: " . $_SERVER['PHP_SELF']); //te envia a la misma página
    exit;
}

// Agregar vehículo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['btn'])) {
    $nombre = $_POST['nome'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tipo = $_POST['tipo'] ?? "";

    if ($nombre == "" || $marca == "" || $modelo == "" || $tipo == "") {
        $_SESSION['vehiculo'] = "<div id='resultado'>
        <p style='color:red;'>Por favor, complete todos los campos.</p></div>";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if ($tipo == "auto") {
        $puertas = $_POST['puertas'];
        $color = $_POST['colorAuto'];
        $vehiculo = new Auto($nombre, $marca, $modelo, $puertas, $color);
    } elseif ($tipo == "Moto") {
        $tipoMoto = $_POST['tipoMoto'];
        $cilindrada = $_POST['cilindrada'];
        $vehiculo = new Moto($nombre, $marca, $modelo, $tipoMoto, $cilindrada);
    } elseif ($tipo == "Camion") {
        $capacidadCarga = $_POST['capacidadCarga'];
        $vehiculo = new Camion($nombre, $marca, $modelo, $capacidadCarga);
    } else {
        $_SESSION['vehiculo'] = "<div id='resultado'>
        <p style='color:red;'>Por favor, complete todos los campos.</p></div>";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    $_SESSION['listaVehiculos'][] = $vehiculo;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos Datossss \(￣︶￣*\))</title>
    <link rel="stylesheet" href="style/styles.css">
    <link rel="shortcut icon" href="style/540-5408654_this-free-icons-png-design-of-pixel-car.png" type="image/x-icon">
</head>

<body>
    <div class="contenedor">
        <h1>Ingrese datos de su vehículo</h1>
        <form action="" method="post">
            <label for="nome">Nombre del vehículo:</label>
            <input type="text" name="nome" id="nome"><br>

            <label for="marca">Marca del vehículo:</label>
            <input type="text" name="marca" id="marca"><br>

            <label for="modelo">Modelo del vehículo:</label>
            <input type="text" name="modelo" id="modelo"><br>

            <label for="modelo">Tipo de vehiculo:</label>
            <select name="tipo" id="tipo">
                <option value="" disabled selected>Elija un vehículo</option>
                <option value="auto">Auto</option>
                <option value="Moto">Moto</option>
                <option value="Camion">Camión</option>
            </select><br>

            <div id="auto" style="display:none;">
                <label for="puertas">Cantidad de puertas</label>
                <input type="number" name="puertas" id="puertas"><br>

                <label for="color">Color del auto</label>
                <select name="colorAuto" id="colorAuto">
                    <option value="" disabled selected>Seleccione un color</option>
                    <option value="Rojo">Rojo</option>
                    <option value="Azul">Azul</option>
                    <option value="Negro">Negro</option>
                    <option value="Blanco">Blanco</option>
                    <option value="Gris">Gris</option>
                    <option value="Verde">Verde</option>
                    <option value="Amarillo">Amarillo</option>
                    <option value="Naranja">Naranja</option>
                </select><br>
            </div>

            <div id="moto" style="display:none;">
                <label for="tipoMoto">Tipo de Moto</label>
                <select name="tipoMoto" id="tipoMoto">
                    <option value="" disabled selected>Seleccione un tipo de moto</option>
                    <option value="Deportiva">Deportiva</option>
                    <option value="Naked">Naked</option>
                    <option value="Cruiser">Cruiser</option>
                    <option value="Touring">Touring / Gran Turismo</option>
                    <option value="Scooter">Scooter / Motoneta</option>
                    <option value="Cafe Racer">Cafe Racer</option>
                    <option value="Retro">Retro / Clásica</option>
                </select><br>

                <label for="cilindrada">Cilindrada</label>
                <input type="number" name="cilindrada" id="cilindrada" min="50" max="2500"><br>
            </div>

            <div id="camion" style="display:none;">
                <label for="capacidadCarga">Capacidad de carga</label>
                <input type="text" name="capacidadCarga" id="capacidadCarga">
            </div>

            <input type="submit" name="btn" value="Enviar">
        </form>

        <div id="resultado">
            <h2>Lista de Vehículos</h2>
            <?php
            if (!empty($_SESSION['listaVehiculos']) && is_array($_SESSION['listaVehiculos'])) {
                foreach ($_SESSION['listaVehiculos'] as $index => $vehiculo) {
                    echo "<div class='vehiculo-info'>";
                    if (method_exists($vehiculo, 'info') && method_exists($vehiculo, 'arrancar')) {
                        echo "<pre>" . $vehiculo->info() . "</pre>";
                        echo "<pre>" . $vehiculo->arrancar() . "</pre>";
                    } else {
                        echo "<p style='color:red;'>Error: El objeto no tiene los métodos esperados.</p>";
                    }

                    // Botón eliminar individual
                    echo "
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='eliminar' value='$index'>
                            <button type='submit' name='btnEliminar' onclick=\"return confirm('¿Eliminar este vehículo?');\">Eliminar</button>
                        </form>
                    ";

                    echo "</div><hr>";
                }
            } else {
                echo "<p>No hay vehículos registrados.</p>";
            }
            ?>
        </div>

        <script> //Verifica que si se tomo una opcion solo muestre la correspondiente
            window.addEventListener('load', () => {
                document.querySelector('form').reset();
            });

            const tipo = document.getElementById("tipo");
            tipo.addEventListener("change", function() {
                document.getElementById("auto").style.display = this.value === "auto" ? "block" : "none";
                document.getElementById("moto").style.display = this.value === "Moto" ? "block" : "none";
                document.getElementById("camion").style.display = this.value === "Camion" ? "block" : "none";
            });
        </script>
    </div>
</body>
</html>
