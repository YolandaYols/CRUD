<?php
$host = "arturosaiza.com";
$usuario = "ugsjwgu5z7wgt";
$contrasena = "guarache";
$base_de_datos = "dbhggkubvmugoy";

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
