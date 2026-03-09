<?php
$conn = new mysqli("localhost", "root", "", "login_db"); #conexion a la base de datos
if ($conn->connect_error) {die("Error de conexión: " . $conn->connect_error);} #comprueba si tiene un fallo 
?>