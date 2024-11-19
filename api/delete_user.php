<?php
require_once('../includes/Users.class.php');


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $result = User::delete_user($id);

        if ($result) {
            http_response_code(200);
            echo json_encode(["message" => "Usuario eliminado exitosamente"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Error al eliminar el usuario o usuario no encontrado"]);
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
