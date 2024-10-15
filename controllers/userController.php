<?php
require_once('models/user.php');

// Clase UserController maneja las interacciones del usuario con la aplicación
class UserController {
    private $userModel;

    // Constructor que inicializa el modelo User
    public function __construct()
     {
        // Se inicializa el modelo User creando una variable que almacena el nuevo usuario
        $this->userModel = new User();
    }

    // Método para mostrar el formulario de login
    public function showLoginForm()
     {
        // Carga la vista principal que contiene el formulario de login
        include 'index.php';
    }

    // Método para procesar el login
    public function login() 
    {
        // Comprobar si el formulario se ha enviado usando POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            // Recuperar los datos del formulario
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Autenticar los datos con el modelo
            if ($this->userModel->authenticate($email, $password)) 
            {
                // Si la autenticación es exitosa, redireccionar al dashboard
                header("Location: dashboard.php?controller=user&action=dashboard");
                exit(); // Detiene la ejecución del script después de la redirección para seguridad
            } else {
                // Si la autenticación falla, establecer un mensaje de error
                $_SESSION['error'] = "Correo electrónico o contraseña incorrectos.";
                // Redirigir al formulario de login para evitar reenvío del formulario
                header("Location: index.php");
                exit(); // Detiene la ejecución del script después de la redirección
            }
        }
    }

    // Método para mostrar el dashboard después del login
    public function dashboard() {
        // Carga la vista del dashboard
        include 'views/user/dashboard.php';
    }
}

