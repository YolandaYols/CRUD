<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    $id = trim($_POST['id']); // Asegúrate de recibir el ID del empleado que se actualizará
    $nombre = trim($_POST['nombre']);
    $edad = trim($_POST['edad']);
    $cedula = trim($_POST['cedula']);
    $sexo = trim($_POST['sexo']);
    $telefono = trim($_POST['telefono']);
    $cargo = trim($_POST['cargo']);
    $salario = trim($_POST['salario']);


    // Actualiza los datos en la base de datos
    $sql = "UPDATE tbl_empleados 
    SET nombre='$nombre', edad='$edad', cedula='$cedula', sexo='$sexo', telefono='$telefono', cargo='$cargo',salario='$salario' WHERE id='$id'";

    if ($conexion->query($sql) === TRUE) {
        header("location:../");
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }

}
