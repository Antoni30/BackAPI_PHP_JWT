<?php
require_once('../includes/Users.class.php');


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $json = file_get_contents('php://input');


    $data = json_decode($json, true);

    if (json_last_error() === JSON_ERROR_NONE && isset($data['id'], $data['username'], $data['email'], $data['nombre_completo'])) {

        $result = User::update_user($data['id'], $data['username'], $data['email'], $data['nombre_completo']);

        if ($result) {
            http_response_code(200);
            echo json_encode(["message" => "Usuario actualizado exitosamente"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Error al actualizar el usuario"]);
        }
    } else {

        http_response_code(400);
        echo json_encode(["error" => "Datos insuficientes o formato JSON incorrecto"]);
    }
} else {

    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>