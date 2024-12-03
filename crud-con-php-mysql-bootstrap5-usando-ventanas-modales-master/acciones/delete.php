<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    // Leer el cuerpo de la solicitud JSON
    $json_data = file_get_contents("php://input");
    // Decodificar los datos JSON en un array asociativo
    $data = json_decode($json_data, true);


    // Verificar si los datos se decodificaron correctamente
    if ($data !== null) {
        $id = $data['id'];
    
        $sql = "DELETE FROM tbl_empleados WHERE id=$id";
        if ($conexion->query($sql) === TRUE) {
            // Mensaje de éxito sin eliminar un archivo de imagen
            echo json_encode(array("success" => true, "message" => "Empleado eliminado correctamente"));
        } else {
            echo json_encode(array("success" => false, "message" => "Error al eliminar el empleado"));
        }
    } else {
        // Si no se proporcionó el parámetro 'id', devolver un mensaje de error
        echo json_encode(array("success" => false, "message" => "El parámetro 'id' no se proporcionó"));
    }
    
}
