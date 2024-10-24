<?php
session_start();

// Incluir el archivo de configuración para tener acceso a las rutas
require_once(__DIR__ . '/../config/config.php');

$inputCode = $_POST['recovery_code'];

// Verificar si el código ingresado coincide con el de la sesión
if ($inputCode == $_SESSION['recovery_code']) {
    // Si coincide, redirigir al usuario a la página de restablecimiento de contraseña
    header('Location: ' . ruta_reset_password);
    exit();
} else {
    // Si no coincide, mostrar un error
    $_SESSION['error'] = 'El código de verificación es incorrecto.';
    header('Location: ' . ruta_verify_code);
    exit();
}
