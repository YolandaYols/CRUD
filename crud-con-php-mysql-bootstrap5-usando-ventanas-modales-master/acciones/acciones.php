<?php
//add existing file
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");
    $tbl_empleados = "tbl_empleados";


    $nombre = trim($_POST['nombre']);
    $edad = trim($_POST['edad']);
    $cedula = trim($_POST['cedula']);
    $sexo = trim($_POST['sexo']);
    $telefono = trim($_POST['telefono']);
    $cargo = trim($_POST['cargo']);
    $salario=trim($_POST['salario']);


    if (isset($_FILES['archivo'])) { // Cambia 'avatar' por 'archivo' si se usa un nuevo nombre para el archivo subido
        $archivoTemporal = $_FILES['archivo']['tmp_name'];
        $nombreArchivo = $_FILES['archivo']['name'];
    
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    
        // Generar un nombre único y seguro para el archivo
        $nombreArchivo = substr(md5(uniqid(rand())), 0, 10) . "." . $extension;
        $rutaDestino = $dirLocal . '/' . $nombreArchivo;
    
        // Mover el archivo a la ubicación deseada
        if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
    
            // Eliminar 'avatar' de la consulta SQL
            $sql = "INSERT INTO $tbl_empleados (nombre, edad, cedula, sexo, telefono, cargo, salario) 
            VALUES ('$nombre', '$edad', '$cedula', '$sexo', '$telefono', '$cargo','$salario')";
    
            if ($conexion->query($sql) === TRUE) {
                header("location:../");
            } else {
                echo "Error al crear el registro: " . $conexion->error;
            }
        } else {
            echo json_encode(array('error' => 'Error al mover el archivo'));
        }
    } else {
        echo json_encode(array('error' => 'No se ha enviado ningún archivo o ha ocurrido un error al cargar el archivo'));
    }
    
}
/**
 * Función para obtener todos los empleados 
 */

function obtenerEmpleados($conexion){
    $sql = "SELECT * FROM tbl_empleados ORDER BY id ASC";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }
    return $resultado;
}
?>