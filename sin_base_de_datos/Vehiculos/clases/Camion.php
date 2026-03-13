<?php
require_once 'Vehiculos.php';
class Camion extends Vehiculos{
    private $capacidadCarga = 0;

    public function __construct($nombre, $marca, $modelo, $capacidadCarga)
    {
        parent::__construct($nombre, $marca, $modelo);
        $this->capacidadCarga = $capacidadCarga;
    }

    public function arrancar()
    {
        return parent::arrancar() . " con un rugido poderoso VROOOOM \n";
    }

    public function info()
    {
        return parent::info() . " Capacidad de carga: " . $this->capacidadCarga . "T \n";
    }
}


?>