<?php
require_once 'Vehiculos.php';
class Moto extends Vehiculos
{
    private $tipoMoto = "";
    private $cilindrada = 0;
    public function __construct($nombre, $marca, $modelo, $tipoMoto, $cilindrada)
    {
        parent::__construct($nombre, $marca, $modelo);
        $this->tipoMoto = $tipoMoto;
        $this->cilindrada = $cilindrada;
    }
    public function arrancar()
    {
        return parent::arrancar() . "con el boton de encendido (ง'̀-'́)ง \n";
    }
    public function info()
    {
        return parent::info() . " Tipo de moto: " . $this->tipoMoto . " Cilindrada: " . $this->cilindrada . "cc \n";
    }
}
