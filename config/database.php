
<?php
//clase que contiene los datos de la conexión a la base de datos.
class Database 

{
    private $host = "127.0.01";
    private $db_name = "sisVentas";
    private $username = " root";
    private $password = "";
    public $conn;

    // Constructor para conectar a la base de datos.
    public function __construct() 
    {
        try {
            // Crear una nueva conexión PDO
            $this->conn = new PDO("mysql:host=localhost;dbname={$this->db_name}", $this->username, $this->password);
            // Configurar atributos PDO para manejo de errores.
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) 
        {
            // Imprimir mensaje de error si la conexión falla
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    // Método para preparar consultas SQL.
    public function prepare($sql) 
    {
        return $this->conn->prepare($sql);
    }
}