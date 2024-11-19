<?php
use \Firebase\JWT\JWT;


define('SECRET_KEY', 'AnTAngGRAPam');

function authenticate() {

    $headers = apache_request_headers();
    if (isset($headers['Authorization'])) {
        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {

            $decoded = JWT::decode($token, SECRET_KEY, array('HS256'));
            return (array) $decoded;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(array("error" => "Token inválido o expirado"));
            exit();
        }
    } else {
        http_response_code(401);
        echo json_encode(array("error" => "Token no proporcionado"));
        exit();
    }
}
?>
