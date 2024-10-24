<?php
session_start();  // Iniciar la sesión para mantener el estado del usuario entre páginas.

// Tiempo máximo de inactividad permitido antes de cerrar la sesión automáticamente.
define('TIEMPO_MAXIMO_INACTIVIDAD', 1800); // 30 minutos expresados en segundos.

// Verificar si ha pasado más tiempo del permitido desde la última actividad registrada.
if (isset($_SESSION['ultimo_tiempo_actividad']) && (time() - $_SESSION['ultimo_tiempo_actividad'] > TIEMPO_MAXIMO_INACTIVIDAD)) {
    session_unset(); // Eliminar todas las variables de sesión.
    session_destroy(); // Destruir la sesión completamente.
    header("Location: login.php"); // Redirigir al usuario al login.
    exit();
}

// Actualizar el tiempo de la última actividad registrada para mantener la sesión activa.
$_SESSION['ultimo_tiempo_actividad'] = time();

// Incluir el modelo de usuario para la autenticación y manejo de usuarios.
require_once('models/userModel.php');  // Asegúrate de que la ruta del archivo sea correcta.

class userController {
    private $userModel;  // Propiedad para almacenar una instancia del modelo de usuario.

    // Constructor del controlador.
    public function __construct() {
        $this->userModel = new UserModel();  // Instancia del modelo de usuario para acceder a métodos de autenticación.
    }

    // Método para mostrar el formulario de login.
    public function showLoginForm() {
        require(__DIR__ . '/..//user/login.php');  // Incluir el formulario de login.
    }

    // Método para manejar el proceso de login.
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];  // Capturar el email enviado desde el formulario.
            $password = $_POST['password'];  // Capturar la contraseña enviada desde el formulario.

            // Autenticar al usuario con el email y la contraseña proporcionada.
            $result = $this->userModel->getUserByEmail($email, $password);

            // Verificar el resultado de la autenticación.
            if ($result === 'no_user') {
                // Si no se encuentra el usuario, enviar mensaje de error.
                $_SESSION['error'] = 'No se encontró ningún usuario con ese correo electrónico.';
            } elseif ($result === 'wrong_password') {
                // Si la contraseña es incorrecta, enviar mensaje de error.
                $_SESSION['error'] = 'La contraseña es incorrecta.';
            } elseif ($result) {
                // Si la autenticación fue exitosa, almacenar el email y rol en la sesión.
                $_SESSION['user'] = $email;  // Almacenar el email del usuario.
                $_SESSION['role'] = $result['rol'];  // Almacenar el rol del usuario.

                // Redirigir al dashboard correspondiente según el rol del usuario.
                // Verifica si el usuario es administrador (rol 1) o un usuario regular (rol 0).
                header('Location: /' . ($result['rol'] == 1 ? 'admin/dashboardAdmin.php' : 'user/dashboardUser.php'));
                exit();
            } else {
                // Si ocurre un error durante la autenticación, mostrar mensaje.
                $_SESSION['error'] = 'Ocurrió un error en la autenticación.';
            }

            // Redirigir al formulario de login si hay algún error.
            header('Location: index.php');
            exit();
        }
    }

    // Método para cerrar la sesión.
    public function logout() {
        session_destroy();  // Destruir todas las variables de sesión.
        header('Location: index.php');  // Redirigir al formulario de login.
        exit();
    }
}
