<?php
$link = new mysqli("db", "usuario", "pariesJAJA", "party");

if ($link->connect_error) {
  die("Conexión fallida: " . $link->connect_error);
}

?>