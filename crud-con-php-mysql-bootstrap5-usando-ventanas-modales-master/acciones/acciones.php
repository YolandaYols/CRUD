<?php
//add existing file
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");
    $tbl_empleados = "tbl_empleados";

    // Sanitizar entradas
    $nombre = mysqli_real_escape_string($conexion, trim($_POST['nombre']));
    $edad = mysqli_real_escape_string($conexion, trim($_POST['edad']));
    $cedula = mysqli_real_escape_string($conexion, trim($_POST['cedula']));
    $sexo = mysqli_real_escape_string($conexion, trim($_POST['sexo']));
    $telefono = mysqli_real_escape_string($conexion, trim($_POST['telefono']));
    $cargo = mysqli_real_escape_string($conexion, trim($_POST['cargo']));
    $salario = mysqli_real_escape_string($conexion, trim($_POST['salario']));

    if (isset($_FILES['archivo'])) {
        $archivoTemporal = $_FILES['archivo']['tmp_name'];
        $nombreArchivo = $_FILES['archivo']['name'];
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        // Verificar tipo de archivo
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($extension, $allowedExtensions)) {
            echo json_encode(['error' => 'Archivo no permitido. Solo se permiten imágenes.']);
            exit;
        }

        $nombreArchivo = substr(md5(uniqid(rand())), 0, 10) . "." . $extension;
        $rutaDestino = $dirLocal . '/' . $nombreArchivo;

        if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
            $sql = "INSERT INTO $tbl_empleados (nombre, edad, cedula, sexo, telefono, cargo, salario) 
                    VALUES ('$nombre', '$edad', '$cedula', '$sexo', '$telefono', '$cargo', '$salario')";

            if ($conexion->query($sql) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => 'Empleado agregado correctamente.']);
            } else {
                echo json_encode(['error' => 'Error al crear el registro: ' . $conexion->error]);
            }
        } else {
            echo json_encode(['error' => 'Error al mover el archivo']);
        }
    } else {
        $sql = "INSERT INTO $tbl_empleados (nombre, edad, cedula, sexo, telefono, cargo, salario) 
                VALUES ('$nombre', '$edad', '$cedula', '$sexo', '$telefono', '$cargo', '$salario')";

        if ($conexion->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Empleado agregado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al crear el registro: ' . $conexion->error]);
        }
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