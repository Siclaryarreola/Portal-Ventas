<?php
require_once(ruta_user_model); // Ruta absoluta correcta al modelo
require_once (ruta_config);  // Ruta a la configuración

class userController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Muestra el login
    public function showLoginForm() 
    {
        require(ruta_login);  // Usar la constante para la ruta del login
    }

    // Función para iniciar sesión
    public function login() 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validar formato del correo electrónico
            if (!preg_match('/^[a-zA-Z0-9._-]+@drg\.mx$/', $email)) {
                $_SESSION['error'] = 'El correo electrónico debe terminar en @drg.mx.';
                header('Location: ' . ruta_login);  // Usar la constante para la ruta del login
                exit();
            }

            // Validar formato de la contraseña (mínimo 8 caracteres, sin espacios)
            if (strlen($password) < 8 || !preg_match('/^[A-Za-z0-9!@#$%^&*()_+=-]+$/', $password)) {
                $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres y solo puede contener letras, números y símbolos permitidos.';
                header('Location: ' . ruta_login);  // Usar la constante para la ruta del login
                exit();
            }

            // Autenticar al usuario
            $user = $this->userModel->getUserByEmail($email, $password);

            // Verificar si se obtuvo un array válido con el usuario
            if (is_array($user)) {
                $_SESSION['user'] = $user;  // Guardar el usuario en la sesión
                $_SESSION['nombre'] = $user['nombre'];

                // Verificar el rol del usuario y redirigir a la página correspondiente
                if ($user['rol'] === 1) {
                    header('Location: ' . ruta_dashboard_admin);  // Usar la constante para la ruta del dashboard admin
                } else {
                    header('Location: ' . ruta_dashboard_user);  // Usar la constante para la ruta del dashboard usuario
                }
                exit();
            } else {
                // Si las credenciales no son correctas
                $_SESSION['error'] = 'Correo electrónico o contraseña incorrectos';
                header('Location: ' . ruta_login);  // Usar la constante para la ruta del login
                exit();
            }
        }
    }

    // Muestra el formulario de registro
    public function showRegistrationForm() 
    {
        require(ruta_register);  // Usar la constante para la ruta del formulario de registro
    }

    // Función para crear una cuenta
    public function createAccount() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Intentar registrar al usuario
            $result = $this->userModel->createUser($nombre, $email, $password);

            if ($result) {
                $_SESSION['success'] = 'Cuenta creada exitosamente.';
                header('Location: ' . ruta_login);  // Redirigir al login
            } else {
                $_SESSION['error'] = 'El correo ya está registrado.';
                header('Location: ' . ruta_register);  // Redirigir al formulario de registro
            }
            exit();
        }
    }

    // Función para cerrar la sesión
    public function logout() 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();  // Destruir la sesión
        header('Location: ' . ruta_login);  // Usar la constante para la ruta del login
        exit();
    }
}
