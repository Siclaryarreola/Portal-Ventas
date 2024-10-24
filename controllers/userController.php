<?php
require_once(__DIR__ . '/../models/userModel.php'); // Ruta absoluta correcta al modelo

class userController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function showLoginForm() {
        require(__DIR__ . '/../views/user/login.php');  // Ruta absoluta para login.php
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Autenticar al usuario
            $user = $this->userModel->getUserByEmail($email, $password);

            // Verificar si se obtuvo un array válido con el usuario
            if (is_array($user)) {
                $_SESSION['user'] = $user;  // Guardar el usuario en la sesión

                // Verificar el rol del usuario y redirigir a la página correspondiente
                if ($user['rol'] === 'admin') {
                    header('Location: /Portal-Ventas/views/admin/dashboardAdmin.php');  // Ruta absoluta al dashboard admin
                } else {
                    header('Location: /Portal-Ventas/views/user/dashboardUser.php');  // Ruta absoluta al dashboard usuario
                }
                exit();
            } else {
                // Si las credenciales no son correctas
                $_SESSION['error'] = 'Correo electrónico o contraseña incorrectos';
                header('Location: /Portal-Ventas/index.php');  // Ruta absoluta al login
                exit();
            }
        }
    }

    public function showRegistrationForm() {
        require(__DIR__ . '/../views/user/register.php');  // Ruta relativa 
    }
    
    public function createAccount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Intentar registrar al usuario
            $result = $this->userModel->createUser($nombre, $email, $password);

            if ($result) {
                $_SESSION['success'] = 'Cuenta creada exitosamente.';
                header('Location: /Portal-Ventas/index.php');  // Ruta absoluta al login
            } else {
                $_SESSION['error'] = 'El correo ya está registrado.';
                header('Location: /Portal-Ventas/index.php?controller=user&action=register');  // Redirigir al registro
            }
            exit();
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();  // Destruir la sesión
        header('Location: /Portal-Ventas/index.php');  // Ruta absoluta al login
        exit();
    }
}
