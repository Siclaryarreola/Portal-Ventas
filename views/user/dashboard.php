<?php
session_start();  // Asegúrate de iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];  // Obtener los detalles del usuario desde la sesión
} else {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de login
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h1>Bienvenido al Dashboard,</h1>
    <p>Has iniciado sesión correctamente como <?php echo $user['name']; ?>.</p>

</body>
</html>
