
class User {
    private $db;

    public function __construct() {
        // Aquí se puede inicializar la conexión a la base de datos.
        $this->db = new Database();
    }

    // Método para autenticar al usuario
    public function authenticate($email, $password) {
        // Aquí se debería realizar la verificación en la base de datos
        if ($email == "test@example.com" && $password == "123456") {
            return true;
        } else {
            return false;
        }
    }
}
