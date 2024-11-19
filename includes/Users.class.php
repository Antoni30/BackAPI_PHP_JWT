<?php

require_once('Database.class.php');

class User {
    public static function create_user($username, $password, $email, $nombre_completo) {
        try {
            $database = new DataBase();
            $conn = $database->getConnection();

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $conn->prepare('INSERT INTO usuarios (username, password, email, nombre_completo) VALUES (:username, :password, :email, :nombre_completo)');

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nombre_completo', $nombre_completo);

            if ($stmt->execute()) {
                header('HTTP/1.1 201 Usuario Creado');
            } else {
                header('HTTP/1.1 400 Error al crear el usuario');
            }

            $conn = null;
        } catch (PDOException $e) {

            error_log("Error en la creación de usuario: " . $e->getMessage());
            header('HTTP/1.1 500 Error interno del servidor');
        }
    }

     public static function update_user($id, $username, $email, $nombre_completo) {
        try {
            $database = new DataBase();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('UPDATE usuarios SET username = :username, email = :email, nombre_completo = :nombre_completo WHERE id = :id');

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nombre_completo', $nombre_completo);

            $result = $stmt->execute();

            $conn = null;

            return $result;
        } catch (PDOException $e) {
            error_log("Error al actualizar el usuario: " . $e->getMessage());
            return false;
        }
    }

    public static function get_user($id) {
        try {
            $database = new DataBase();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('SELECT id, username, email, nombre_completo FROM usuarios WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $conn = null;

            return $user ? $user : false;
        } catch (PDOException $e) {
            error_log("Error al obtener el usuario: " . $e->getMessage());
            return false;
        }
    }

    public static function delete_user($id) {
        try {
            $database = new DataBase();
            $conn = $database->getConnection();


            $stmt = $conn->prepare('DELETE FROM usuarios WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $conn = null;
                return true;
            } else {
                $conn = null;
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error al eliminar el usuario: " . $e->getMessage());
            return false;
        }
    }

    public static function get_user_by_username($username) {
        try {
            $database = new DataBase();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('SELECT id, username, password FROM usuarios WHERE username = :username');
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);


            $conn = null;

            return $user ? $user : false;
        } catch (PDOException $e) {
            error_log("Error al obtener el usuario: " . $e->getMessage());
            return false;
        }
    }
}
?>
