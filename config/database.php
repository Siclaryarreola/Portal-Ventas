<?php
//clase que contiene los datos de conexión a la base de datos en privado
class Database {
    private $host = "localhost:3306";
    private $db_name = "intran23_sistema";
    private $username = "intran23_root";
     private $password = "Intranet12_";

//la variable almacena los datos de la conexion y se puede llamar desde donde sea por ser publica
    public $conn;
// Añade esta variable para almacenar las declaraciones preparadas
private $stmt; 

    //verifica la conexión a la base de datos mediante una función pública 
    public function getConnection() 
    {
        $this->conn = null;
        //En caso de que la conexión no se pueda realizar, envía un error avisando que no se coneectó
        try 
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) 
        {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

