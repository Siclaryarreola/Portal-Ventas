<?php
session_start();  // Iniciar la sesión para mantener el estado del usuario entre páginas.

// Tiempo máximo de inactividad permitido antes de cerrar la sesión automáticamente.
define('TIEMPO_MAXIMO_INACTIVIDAD', 1800); // 30 minutos expresados en segundos.

// Verificar si ha pasado más tiempo del permitido desde la última actividad registrada.
if (isset($_SESSION['ultimo_tiempo_actividad']) && (time() - $_SESSION['ultimo_tiempo_actividad'] > TIEMPO_MAXIMO_INACTIVIDAD)) {
    session_unset(); // Eliminar las variables de sesión.
    session_destroy(); // Destruir la sesión completamente.
    header("Location: login.php"); // Redirigir al usuario al login.
    exit;
}

// Actualizar el tiempo de la última actividad registrada.
$_SESSION['ultimo_tiempo_actividad'] = time();

// Incluir el modelo de usuario para la autenticación y manejo de usuarios.
require_once('models/userModel.php');

class userController {
    private $userModel;  // Propiedad para almacenar una instancia del modelo de usuario.

    public function __construct() {
        $this->userModel = new UserModel();  // Instancia del modelo de usuario.
    }

    public function showLoginForm() {
        require(__DIR__ . '/../views/user/login.php');  // Incluir el formulario de login.
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];  // Capturar el email del formulario.
            $password = $_POST['password'];  // Capturar la contraseña del formulario.

            // Autenticar al usuario con las credenciales proporcionadas.
            $result = $this->userModel->getUserByEmail($email, $password);

            // Verificar si el resultado fue un error o autenticación exitosa.
            if ($result === 'no_user') {
                $_SESSION['error'] = 'No se encontró ningún usuario con ese correo electrónico.';
            } elseif ($result === 'wrong_password') {
                $_SESSION['error'] = 'La contraseña es incorrecta.';
            } elseif ($result) {
                $_SESSION['user'] = $email;  // Almacenar el email en la sesión.
                $_SESSION['role'] = $result;  // Almacenar el rol en la sesión.

                // Redirigir al dashboard correspondiente según el rol del usuario.
                header('Location: views/' . ($result === 'admin' ? 'admin/dashboard_admin.php' : 'user/dashboard_user.php'));
                exit();
            } else {
                $_SESSION['error'] = 'Ocurrió un error en la autenticación.';
            }

            // Redirigir al formulario de login si hubo un error.
            header('Location: index.php');
            exit();
        }
    }

    public function logout() {
        session_destroy();  // Destruir todas las variables de sesión.
        header('Location: index.php');  // Redirigir al inicio.
        exit();
    }
}
