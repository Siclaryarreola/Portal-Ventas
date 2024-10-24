<?php
session_start();

$inputCode = $_POST['recovery_code'];

// Verificar si el código ingresado coincide con el de la sesión
if ($inputCode == $_SESSION['recovery_code']) {
    // Si coincide, redirigir al usuario a la página de restablecimiento de contraseña
    header('Location: resetPass.php');
    exit();
} else {
    // Si no coincide, mostrar un error
    $_SESSION['error'] = 'El código de verificación es incorrecto.';
    header('Location: views/verifyCode.php');
    exit();
}
