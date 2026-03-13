<?php

class Automovil {
    public $marca = "";
    public $modelo = "";
    public $color = "";
    
    public function __construct($marca, $modelo, $color){
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->color = $color;
        
    }
    
    public function tipo(){
        return "Vehiculo";
        
    }
    
    public function pablo(){
        return "<br>" . "Info del Vehiculo :". "<br>" . 
        "Marca: ". $this->marca . "<br>".
        "Modelo: ". $this->modelo . "<br>".
        "Color : " . $this->color . "<br>";
    }
    
    public function uniqua(){
        return "El Vehiculo ha sido arrancado. RUM RUM " . "<br>" ;
    }
    public function sasha (){
        return "El Vehiculo se frenó";
    }
    
    
}

class Bicicleta extends Automovil {
    public $pedales = true;
    public $res = "";
    
    public function __construct($marca, $modelo, $color, $pedales){
        parent::__construct($marca, $modelo, $color);
        $this->pedales = $pedales;
    }
    public function timbre(){
        return "La Bicicleta hace ring ring";
        
    }
    
    public function pedal(){
       $this->res = $this->pedales ? "Si" ."<br>" : "No"."<br>" ;
        
    }
    
    public function pablo(){
        return parent::pablo() . "¿Tiene pedales? " . $this->res;
    }
}

class Auto extends Automovil {
    public $cambios = 0;
    
    public function __construct($marca, $modelo, $color, $cambios){
        parent::__construct($marca, $modelo, $color);
        $this->cambios = $cambios;
    }
    
    public function pablo(){
        return parent::pablo() . "¿Cuantos cambios? " . $this->cambios ."<br>";
    }
}

// Crear 2 bicicletas
$bici1 = new Bicicleta("Trek", "FX 3", "Azul", true);
$bici2 = new Bicicleta("Giant", "Escape 2", "Negra", false);

// Crear 3 autos
$auto1 = new Auto("Toyota", "Corolla", "Rojo", 6);
$auto2 = new Auto("Ford", "Focus", "Gris", 5);
$auto3 = new Auto("Chevrolet", "Cruze", "Blanco", 6);

// Preparar datos de pedales para las bicis
$bici1->pedal();
$bici2->pedal();

// Guardar todo en un arreglo
$vehiculos = [$bici1, $bici2, $auto1, $auto2, $auto3];

// Mostrar los datos de cada objeto
foreach ($vehiculos as $vehiculo) {
    echo "------------------------------" . "<br>";
    
    // Mostrar según el tipo de objeto
    if ($vehiculo instanceof Bicicleta) {
        echo "Tipo: Bicicleta" . "<br>";
        echo $vehiculo->pablo();
        echo $vehiculo->timbre() . "<br>";
    } elseif ($vehiculo instanceof Auto) {
        echo "Tipo: Auto" . "<br>";
        echo $vehiculo->pablo();
        echo $vehiculo->uniqua();
    }
    echo "------------------------------" . "<br><br>";
}
?>
