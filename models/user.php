<?php
//datos para hacer la conexión a la base de datos
class Database {
    private $host = "localhost:3306";
    private $db_name = "intran23_sistema";
    private $username = "intran23_root";
    private $password = "Intranet12_";
    public $conn;
     // Variable para almacenar las declaraciones preparadas
     private $stmt;

    //funcion para verificar la conexión a la base de datos
     public function getConnection()
     {
        //en caso de que la conexión no se pudo realizar, envia un error.
        $this->conn = null;
        try
         {
            //accede a las variables que contienen los datos de conexión
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) 
        {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }

    // Método para preparar las consultas SQL
    public function query($sql) 
    {
        $this->stmt = $this->conn->prepare($sql);
    }

    // Método para vincular parámetros a la consulta preparada
    public function bind($param, $value, $type = null) 
    {
        if (is_null($type)) 
        {
            switch (true)
             {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Método para ejecutar la consulta preparada y devolver una única fila
    public function single() 
    {
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
}
