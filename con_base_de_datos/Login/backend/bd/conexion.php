<?php
$host = "base_de_datos";
$user = "usuario";
$pass = "contrasena";
$database = "login_db";
$conn = new mysqli($host, $user, $pass, $database); #conexion a la base de datos
if ($conn->connect_error) {die("Error de conexión: " . $conn->connect_error);} #comprueba si tiene un fallo 
?>