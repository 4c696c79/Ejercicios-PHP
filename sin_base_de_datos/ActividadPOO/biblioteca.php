<?php

class Biblioteca{
    private $libros = [];
    public function agregarLibro($libro){
        $this->libros[] = $libro;
    }
    public function mostrarLibros(){
        foreach($this->libros as $libro){
            echo $libro->mostrarDatos() . "<br>";
        }
    }
}
//fin de la clase biblioteca

class Libros
{
    public $titulo;
    public $autor;
    private $estado; // disponible, prestado. por defecto disponible

    public function __construct($tituloL, $autorL, $estadoL)
    {
        $this->titulo = $tituloL;
        $this->autor = $autorL;
        $this->estado = $estadoL;
    }
    public function mostrarDatos()
    {
        return 'Actualmente el libro "' . $this->titulo . '" del autor "' . $this->autor . '" esta ' . $this->estado;
    }

    public function prestarL()
    {
        if ($this->estado === "disponible") {
            $this->estado = "prestado";
            echo "En caso de que el libro este disponible se activa un if que presta el libro" . "<br>";
            $this->mostrarDatos();
            return "<span style = 'color:blue'>El libro " . $this->titulo . " ha sido prestado</span>";

        } elseif ($this->estado === "prestado") {
            echo "En caso de que el libro este prestado se activa un elseif que indica que no esta disponible" . "<br>";
            return "<span style = 'color:red'>El libro " . $this->titulo . " no se encuentra disponible</span>";
        }
    }
    public function devolverL()
    {
        if ($this->estado === "prestado") {
            $this->estado = "disponible";
            echo "En caso de que el libro este prestado se activa un if que devuelve el libro" . "<br>";
            $this->mostrarDatos();
            return "<span style = 'color:green'>El libro " . $this->titulo . " ha sido devuelto, se encuentra disponible</span>";

        }else {
            echo "En caso de que el libro este disponible se activa un else que indica que no se puede devolver" . "<br>";
            return "<span style = 'color:red'>El libro " . $this->titulo . " no se encuentra prestado, no se puede devolver</span>";
        }
    }
}
//fin de la clase libros

//Pruebas
//Crear objeto de la clase Biblioteca
$objBiblioteca = new Biblioteca();



//Crear objetos de la clase Libros
$objLibro1 = new Libros("El principito", "Antoine de Saint-Exupéry", "disponible");
$objLibro2 = new Libros("Cien años de soledad", "Gabriel García Márquez", "prestado");
$objLibro3 = new Libros("Don Quijote de la Mancha", "Miguel de Cervantes", "disponible");

echo "Ejemplo 1 <br>". $objLibro1->mostrarDatos() . "<br>";
echo $objLibro1->prestarL() . "<br>";
echo "<br><br>";
echo "Ejemplo 2 <br>".$objLibro2->mostrarDatos() . "<br>";
echo $objLibro2->prestarL() . "<br><br>";
echo "En este caso esta prestado entonces se devuelve<br>". $objLibro2->devolverL() . "<br>";
echo $objLibro2->prestarL() . "<br>";
echo "<br><br>";
echo "Ejemplo 3 <br>".$objLibro3->mostrarDatos() . "<br>";
echo $objLibro3->devolverL() . "<br>";
echo $objLibro3->prestarL() . "<br>";

echo "<br><br><br><br><br><br><br><br>";
