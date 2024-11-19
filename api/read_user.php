<?php
require_once('../includes/Users.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $user = User::get_user($id);

        if ($user) {
            http_response_code(200);
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Usuario no encontrado"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "ID de usuario no proporcionado"]);
    }
} else {

    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>


