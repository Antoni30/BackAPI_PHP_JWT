<?php
class DataBase {
    private $host = 'localhost:3306';
    private $db = 'Movil'; 
    private $user = 'root'; 
    private $password = 'adminadmin123'; 


    public function getConnection() {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=utf8mb4";
    
        try {
            $connection = new PDO($dsn, $this->user, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {

            error_log("ERROR de conexión: " . $e->getMessage());
            die("ERROR: No se pudo conectar a la base de datos.");
        }
    }
}
?>
