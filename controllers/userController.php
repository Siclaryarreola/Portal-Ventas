
class UserController {
    private $userModel;

    public function __construct() {
        // Se inicializa el modelo User
        $this->userModel = new User();
    }

    // Método para mostrar el formulario de login
    public function showLoginForm() {
        include 'views/user/login.php';
    }

    // Método para procesar el login
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Autenticación con el modelo
            if ($this->userModel->authenticate($email, $password)) {
                header("Location: index.php?controller=user&action=dashboard");
            } else {
                $error = "Correo electrónico o contraseña incorrectos.";
                include 'views/user/login.php';
            }
        }
    }

    // Método para mostrar el dashboard después del login
    public function dashboard() {
        include 'views/user/dashboard.php';
    }
}
