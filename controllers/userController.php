<?php
require_once(ruta_userModel); // Usa la constante para la ruta del modelo de usuario
require_once(ruta_config);    // Asegúrate de incluir la configuración

class userController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Muestra el formulario de login
    public function showLoginForm() {
        require(ruta_login);  // Usa la constante para la ruta del login
    }

    // Función para iniciar sesión
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validaciones de correo y contraseña
            if (!preg_match('/^[a-zA-Z0-9._-]+@drg\.mx$/', $email)) {
                $_SESSION['error'] = 'El correo electrónico debe terminar en @drg.mx.';
                header('Location: ' . ruta_login);  // Redirige al login
                exit();
            }

            if (strlen($password) < 8 || !preg_match('/^[A-Za-z0-9!@#$%^&*()_+=-]+$/', $password)) {
                $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres y solo puede contener letras, números y símbolos permitidos.';
                header('Location: ' . ruta_login);  // Redirige al login
                exit();
            }

            // Autenticación del usuario
            $user = $this->userModel->getUserByEmail($email, $password);

            if (is_array($user)) {
                $_SESSION['user'] = $user;
                $_SESSION['nombre'] = $user['nombre'];

                // Redirigir según el rol del usuario
                if ($user['rol'] === 1) {
                    header('Location: ' . ruta_dashboardAdmin);  // Admin dashboard
                } else {
                    header('Location: ' . ruta_dashboardUser);  // Usuario dashboard
                }
                exit();
            } else {
                $_SESSION['error'] = 'Correo electrónico o contraseña incorrectos';
                header('Location: ' . ruta_login);  // Redirige al login
                exit();
            }
        }
    }

    // Función para mostrar el formulario de registro
    public function showRegistrationForm() {
        require(ruta_register);  // Usa la constante para la ruta del formulario de registro
    }

    // Función para crear una cuenta
    public function createAccount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->userModel->createUser($nombre, $email, $password);

            if ($result) {
                $_SESSION['success'] = 'Cuenta creada exitosamente.';
                header('Location: ' . ruta_login);  // Redirige al login
            } else {
                $_SESSION['error'] = 'El correo ya está registrado.';
                header('Location: ' . ruta_register);  // Redirige al formulario de registro
            }
            exit();
        }
    }

    // Función para cerrar sesión
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: ' . ruta_login);  // Redirige al login
        exit();
    }
}
