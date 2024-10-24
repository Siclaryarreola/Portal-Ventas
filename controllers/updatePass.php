<?php
// Iniciar la sesión para acceder a las variables almacenadas en la sesión
session_start();

// Incluir la conexión a la base de datos
require_once('config/database.php');

// Obtener las nuevas contraseñas ingresadas por el usuario
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

// Obtener el correo electrónico almacenado en la sesión (guardado durante el proceso de recuperación)
$email = $_SESSION['recovery_email'];

// Verificar si las contraseñas coinciden
if ($newPassword !== $confirmPassword) 
{
    // Si las contraseñas no coinciden, guardar un mensaje de error en la sesión
    $_SESSION['error'] = 'Las contraseñas no coinciden.';
    // Redirigir al formulario de restablecimiento de contraseña
    header('Location: resetPass.php');
    exit();  // Terminar la ejecución del script
}

// Si las contraseñas coinciden, proceder a hashear la nueva contraseña
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Actualizar la contraseña en la base de datos para el usuario con el correo proporcionado
$sql = "UPDATE usuarios SET contraseña = ? WHERE correo = ?";
$stmt = $db->prepare($sql);  // Preparar la consulta SQL
$stmt->bind_param("ss", $hashedPassword, $email);  // Vincular los parámetros (contraseña hasheada y correo)
$stmt->execute();  // Ejecutar la consulta

// Verificar si la actualización de la contraseña fue exitosa
if ($stmt->affected_rows > 0)
 {
    // Si fue exitosa, guardar un mensaje de éxito en la sesión
    $_SESSION['success'] = 'Contraseña actualizada exitosamente. Ahora puedes iniciar sesión.';
    // Redirigir al formulario de inicio de sesión
    header('Location: views/login.php');
    exit();  // Terminar la ejecución del script
} else {
    // Si hubo un error al actualizar la contraseña, guardar un mensaje de error en la sesión
    $_SESSION['error'] = 'No se pudo actualizar la contraseña. Inténtalo de nuevo.';
    // Redirigir nuevamente al formulario de restablecimiento de contraseña
    header('Location: resetPass.php');
    exit();  // Terminar la ejecución del script
}
