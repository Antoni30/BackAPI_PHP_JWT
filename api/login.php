<?php
require_once('../vendor/autoload.php');  // Asegúrate de incluir el autoloader de Composer
require_once('../includes/Users.class.php');

use \Firebase\JWT\JWT;

define('SECRET_KEY', 'AnTAngGRAPam');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    if (isset($data['username'], $data['password'])) {
        $username = $data['username'];
        $password = $data['password'];

        // Obtener el usuario de la base de datos
        $user = User::get_user_by_username($username);

        if ($user && password_verify($password, $user['password'])) {

            $issuedAt = time();
            $expirationTime = $issuedAt + 3600;  // El token expira en 1 hora
            $payload = array(
                "iat" => $issuedAt,
                "exp" => $expirationTime,
                "username" => $user['username'],
                "id" => $user['id']
            );

            // Incluir el algoritmo de firma como tercer parámetro
            $jwt = JWT::encode($payload, SECRET_KEY, 'HS256');

            http_response_code(200);
            echo json_encode(array("ID" => $user['id'],"message" => "Login exitoso", "token" => $jwt ,"username" => $username ));
        } else {
            http_response_code(401);
            echo json_encode(array("error" => "Credenciales inválidas"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Datos insuficientes"));
    }
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Método no permitido"));
}
?>
