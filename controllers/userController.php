<?php
require_once('models/user.php');  // Asegúrate de que esta ruta es correcta

class userController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLoginForm() {
        require(__DIR__ . '/../views/user/login.php');  // Ruta absoluta para login.php
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->authenticate($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: views/user/dashboard.php');
                exit();
            } else {
                $_SESSION['error'] = 'Correo electrónico o contraseña incorrectos';
                header('Location: index.php');
                exit();
            }
        }
    }

    public function showRegistrationForm() {
        include 'views/user/register.php';  // Asegúrate de que la ruta sea correcta
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

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
