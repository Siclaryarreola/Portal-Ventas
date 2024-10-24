<?php
//inicia la sesion
session_start(); 
// Ajuste de la ruta para incluir el archivo de configuración de la base de datos
require_once(dirname(__DIR__, 2) . '/config/database.php');  // Sube dos niveles desde views/admin para llegar a la raíz

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de login
    header('Location: index.php');
    exit();
}

// Tiempo máximo de inactividad permitido antes de cerrar la sesión automáticamente.
define('TIEMPO_MAXIMO_INACTIVIDAD', 1800); // 30 minutos expresados en segundos.

// Verificar si ha pasado más tiempo del permitido desde la última actividad registrada.
if (isset($_SESSION['ultimo_tiempo_actividad']) && (time() - $_SESSION['ultimo_tiempo_actividad'] > TIEMPO_MAXIMO_INACTIVIDAD)) {
    session_unset(); // Eliminar las variables de sesión.
    session_destroy(); // Destruir la sesión completamente.
    header("Location: login.php"); // Redirigir al usuario al login.
    exit();
}

// Actualizar el tiempo de la última actividad registrada.
$_SESSION['ultimo_tiempo_actividad'] = time();

// Obtener el ID del usuario desde la sesión
$userId = $_SESSION['user_id'];

// Conectar a la base de datos
$db = Database::getInstance()->getConnection();

// Consultar el nombre y el rol del usuario en la base de datos
$sql = "SELECT nombre, rol FROM usuarios WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $userId);  // Vincular el ID del usuario
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Obtener los datos del usuario
    $user = $result->fetch_assoc();
    $userName = htmlspecialchars($user['nombre']);  // Obtener el nombre del usuario de la base de datos
    $userRole = $user['rol'];  // Obtener el rol del usuario
} else {
    // Si no se encuentra el usuario, redirigir al login
    session_unset(); 
    session_destroy();
    header('Location: login.php');
    exit();
}

// Redirigir al dashboard según el rol del usuario
if ($userRole == 1) {
    // Usuario administrador
    header('Location: dashboard_admin.php');
    exit();
} else {
    // Usuario estándar
    header('Location: dashboard_user.php');
    exit();
}

?>
