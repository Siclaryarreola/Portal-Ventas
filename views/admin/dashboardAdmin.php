<?php
session_start();  // Asegúrate de iniciar la sesión
// Verificar si el usuario ha iniciado sesión


if (isset($_SESSION['user'])) 
{
    $user = $_SESSION['user'];  // Obtener los detalles del usuario desde la sesión
} else 
{
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de login
    header('Location: login.php');
    exit();
}


// Tiempo máximo de inactividad permitido antes de cerrar la sesión automáticamente.
define('TIEMPO_MAXIMO_INACTIVIDAD', 180); 

// Verificar si ha pasado más tiempo del permitido desde la última actividad registrada.
if (isset($_SESSION['ultimo_tiempo_actividad']) && (time() - $_SESSION['ultimo_tiempo_actividad'] > TIEMPO_MAXIMO_INACTIVIDAD))
{
    session_unset(); // Eliminar las variables de sesión.
    session_destroy(); // Destruir la sesión completamente.
    header("Location: login.php"); // Redirigir al usuario al login.
    exit();
}

// Actualizar el tiempo de la última actividad registrada.
$_SESSION['ultimo_tiempo_actividad'] = time();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Bienvenido al Dashboard de Administrador</h1>
    <p>Has iniciado sesión correctamente como <?php echo htmlspecialchars($nombre); ?>.</p>
    <p>Esto es una vista solo para administradores.</p>

    <!-- Botón para cerrar sesión -->
    <form action="../../controllers/userControllers.php" method="POST">
    <button type="submit">Cerrar Sesión</button>
    </form>

</body>
</html>
