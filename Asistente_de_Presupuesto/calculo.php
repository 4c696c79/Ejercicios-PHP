<?php
session_start();
$mensaje = "";
$resultado = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Datos del formulario

    $disponible      = isset($_POST['disponible']) ? floatval($_POST['disponible']) : 0;
    $cantidadAdultos = isset($_POST['cantidadAdultos']) ? intval($_POST['cantidadAdultos']) : 0;
    $cantidadNinos   = isset($_POST['cantidadNinos']) ? intval($_POST['cantidadNinos']) : 0;
    $costoAdulto     = isset($_POST['costoAdulto']) ? floatval($_POST['costoAdulto']) : 0;
    $costoNino       = isset($_POST['costoNino']) ? floatval($_POST['costoNino']) : 0;
    $recomendacion   = "";

    if ($disponible <= 0 || $costoAdulto < 0 || $costoNino < 0) {
        $mensaje = "Complete los campos obligatorios para evaluar el presupuesto";
    } else {
        //Calculos
        $totalAdultos = $cantidadAdultos * $costoAdulto;
        $totalNinos = $cantidadNinos * $costoNino;
        $totalInvitados = $cantidadAdultos + $cantidadNinos;
        $costoInvitados = $totalAdultos + $totalNinos;
        $costoTotal = 0;

        //Costos adicionales
        $adicionales = $_POST['adicional'] ?? [];
        $costoAdicional = array_sum($adicionales);

        //Costo total
        $costoTotal = ($costoInvitados + $costoAdicional);
        $costoTotal = round($costoTotal, 2);



        //Tipo de servicio
        $tipoServicio = $_POST["menu"] ?? "estandar";
        switch ($tipoServicio) {
            case "economico":
                $costoTotal *= 1.10; //Aumento del 10%
                break;
            case "estandar":
                $costoTotal *= 1.30; //Aumento del 30%
                break;
            case "premium":
                $costoTotal *= 1.50; //Aumento del 50%
                break;
            default:
                $costoTotal *= 1.0; //Sin aumento
                break;
        }
        $costoTotal = round($costoTotal, 2);

        //Costo promedio por persona
        $promedio = $totalInvitados > 0 ? $costoTotal / $totalInvitados : 0;
        $promedio = round($promedio, 2);


        //Recomendaciones
        switch (true) {
            case ($costoTotal <= 1000):
                $recomendacion = "Evento pequeño, pero traigan coca o(￣▽￣)ｄ";
                break;
            case ($costoTotal < 5000):
                $recomendacion = "Evento mediano, disfruten \(￣︶￣*\))";
                break;
            case ($costoTotal >= 5000):
                $recomendacion = "Gran evento, ¡a disfrutar se ha dicho! ＼(＾▽＾)／";
                break;
            default:
                $recomendacion = "...";
                break;
        }
        //Evaluar presupuesto
        $presupuestoSuficiente = $costoTotal <= $disponible;
        $costoRestante = $disponible - $costoTotal;
        $costoRestante = round($costoRestante, 2);
        //Costo promedio por persona

        $resultado = [
            'totalAdultos' => $totalAdultos,
            'totalNinos' => $totalNinos,
            'invitados' => $totalInvitados,
            'presupuesto' => $disponible,
            'promedio' => $promedio,
            'costoInvitados' => $costoInvitados,
            'costoAdicional' => $costoAdicional,
            'costoTotal' => $costoTotal,
            'costoRestante' => $costoRestante,
            'recomendacion' => $recomendacion,
            'suficiente' => $presupuestoSuficiente // true o false
        ];
        $formulario = "Fecha de creación " . date("d/m/Y H:i:s") . PHP_EOL .
            "Presupuesto: $disponible \n" .
            "Cantidad de adultos: $cantidadAdultos \n" .
            "Cantidad de niños: $cantidadNinos \n" .
            "Costo por adulto: $costoAdulto \n" .
            "Costo por niño: $costoNino \n" .
            "Costo invitados: $costoInvitados \n" .
            "Costo adicional: $costoAdicional \n" .
            "Tipo de servicio: $tipoServicio \n" .
            "Costo total: $costoTotal \n" .
            "Recomendación: $recomendacion \n" .
            "Presupuesto suficiente: " . ($presupuestoSuficiente ? 'Sí' : 'No') . PHP_EOL . PHP_EOL;
        file_put_contents("Registros.txt", $formulario, FILE_APPEND | LOCK_EX);
    } //fin de los calculos
    $_SESSION['mensaje'] = $mensaje;
    $_SESSION['resultado'] = $resultado;

    header("Location: index.php");
    exit;
} //fin del post