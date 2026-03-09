<?php
session_start();
if (!empty($_SESSION['id'])) { #comprueba si hay session, si lo hay, la cierra
    session_unset();
    session_destroy();
    header('location:../../frontend/index.php');
    exit;
} else {
    header('location:../../frontend/index.php');
    exit;
}
