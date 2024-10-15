
class UserController
 {
    private $userModel;

    public function __construct()
     {
        // Se inicializa el modelo User creando una variable que almacena el nuevo usuario
        $this->userModel = new User();
    }

    // Método para mostrar el formulario de login
    public function showLoginForm() 
    {
       // include 'views/user/login.php';
       include 'index.php';
    }

    // Método para procesar el login
    public function login() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
         {
            //variables que almacenan los datos ingresados en el index
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Autenticación  de datos con el modelo
            if ($this->userModel->authenticate($email, $password))
             {
                //redirecciona al documento dashboard si los datos son correctos
                header("Location: dashboard.php?controller=user&action=dashboard");
            } else 
            {
                //envía un error si los datos ingresados no son correctos
                $error = "Correo electrónico o contraseña incorrectos.";
                include 'index.php';
            }
        }
    }

    // Método para mostrar el dashboard después del login
    public function dashboard()
     {
        include 'views/user/dashboard.php';
    }
}
