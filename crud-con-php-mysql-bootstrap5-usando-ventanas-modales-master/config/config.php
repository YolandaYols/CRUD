<?php
$host = "127.0.0.1";
$usuario = "root";
$contrasena = "20721Mar";
$base_de_datos = "tiendadb";

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
