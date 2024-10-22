
<?php
require_once('models/userModel.php');  // Asegúrate de que esta ruta es correcta

class userController
 {
    private $userModel;

    public function __construct()
     {
        $this->userModel = new UserModel();
    }

    public function showLoginForm() 
    {
        require(__DIR__ . '/../views/login.php');  // Ruta absoluta para login.php
    }
    public function login() 
    {
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userModel->getUserByEmail($email, $password);

        // Verificar si $user es un array antes de intentar acceder a 'role'
        if (is_array($user))
         {
            $_SESSION['user'] = $user;

            // Verificar el rol del usuario
            if ($user['rol'] === 'admin') {
                header('Location: ../views/admin/dashboard_admin.php');
            } else {
                header('Location: ../views/user/dashboard_user.php');
            }
            exit();
        } else {
            // Si las credenciales son incorrectas o no se encontró el usuario
            $_SESSION['error'] = 'Correo electrónico o contraseña incorrectos';
            header('Location: index.php');
            exit();
        }
    }
}



public function showRegistrationForm()
 {
    include 'views/register.php';  // Asegúrate de que la ruta sea correcta
}

public function createAccount() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Intentamos registrar al usuario
        $result = $this->userModel->register($nombre, $email, $password);

        if ($result) {
            $_SESSION['success'] = 'Cuenta creada exitosamente.';
            header('Location: index.php');
        } else {
            $_SESSION['error'] = 'El correo ya está registrado.';
            header('Location: index.php?controller=user&action=register');
        }
        exit();
    }
}


    public function logout()
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
