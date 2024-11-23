<?php
require_once('../includes/Users.class.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);


    if (json_last_error() === JSON_ERROR_NONE && isset($data['username'], $data['password'], $data['email'], $data['nombre_completo'])) {

        User::create_user($data['username'], $data['password'], $data['email'], $data['nombre_completo']);

        http_response_code(200);
        echo json_encode(array("success" => true));
    } else {

        http_response_code(400);
        echo json_encode(["error" => "Datos insuficientes o formato JSON incorrecto"]);
    }
} else {

    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>
