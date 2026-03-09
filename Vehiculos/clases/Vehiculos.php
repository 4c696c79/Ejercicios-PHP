<?php
class Vehiculos {
protected $nombre;
protected $marca;
protected $modelo;

public function __construct ($nombre, $marca, $modelo) {
    $this->nombre = $nombre;
    $this->marca = $marca;
    $this->modelo = $modelo;

}    

public function arrancar() {
    return "El vehiculo {$this->marca} {$this->modelo} ha arrancado ";
}

public function info (){
    return "Descripcion del vehiculo: \n" . "Marca: " . $this->marca . " Modelo: " . $this->modelo . "\n";
}
}
?>