<?php
session_start();  // Iniciar la sesión
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

require_once('controllers/userController.php');  // Asegúrate de que esta ruta sea correcta

// Verificar si se ha pasado un controlador y una acción por la URL
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];

    // Crear instancia del controlador correspondiente si es necesario
    if ($controller === 'user') {
        $userController = new userController();

        // Manejar las diferentes acciones de usuario
        if ($action === 'login') {
            $userController->login();  // Procesar el login
        } elseif ($action === 'register') {
            $userController->showRegistrationForm();  // Mostrar el formulario de registro
        } elseif ($action === 'createAccount') {
            $userController->createAccount();  // Procesar la creación de una cuenta
        } elseif ($action === 'logout') {
            $userController->logout();  // Cerrar sesión
        } else {
            // Acción no reconocida, redirigir al login por defecto
            $userController->showLoginForm();
        }
    }
} else {
    // Verificar si el usuario ha iniciado sesión
    if (isset($_SESSION['user'])) {
        // Si el usuario ya ha iniciado sesión, redirigir al dashboard
        header('Location: ../admin/dashboardAdmin.php');
        exit();
    } else {
        // Si no ha iniciado sesión, mostrar el formulario de login
        $userController = new userController();
        $userController->showLoginForm();
    }
}
