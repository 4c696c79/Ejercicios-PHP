<?php

//conexion BD
$server = "localhost";
$user = "root";
$pass = "";
$database = "party";

$link = new mysqli($server, $user, $pass, $database);

if ($link->connect_error) {
  die("Conexión fallida: " . $link->connect_error);
}

?>