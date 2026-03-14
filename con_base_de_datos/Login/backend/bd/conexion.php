<?php
$conn = new mysqli("base_de_datos", "usuario", "contrasena", "login_db"); #conexion a la base de datos
if ($conn->connect_error) {die("Error de conexión: " . $conn->connect_error);} #comprueba si tiene un fallo 
?>