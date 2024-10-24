<?php
// Ruta correcta a la configuración de la base de datos
require_once(ruta_database);

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // Verificar conexión
        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }
        $this->connection->set_charset("utf8"); // Establece el juego de caracteres a utf8
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
