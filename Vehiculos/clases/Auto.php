<?php
require_once 'Vehiculos.php';

class Auto extends Vehiculos{
private $puertas = 0;
private $color = "";

public function __construct ($nombre, $marca, $modelo, $puertas, $color){
    parent:: __construct($nombre, $marca, $modelo);
    $this->puertas = $puertas;
    $this->color = $color;

}

public function arrancar (){
    return parent::arrancar() ."con la llave magica ㄟ(≧v≦)ㄏ \n";
}
public function info(){
    return parent::info() . " Puertas: " . $this->puertas . " Color: " . $this->color . "\n";}

}

?>