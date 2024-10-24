<?php
session_start();


require_once(ruta_database);  // Archivo de conexión a la base de datos

// Recuperar el email del formulario
$email = $_POST['email'];

// Obtener la conexión a la base de datos
$db = Database::getInstance()->getConnection();

// Verificar si el correo electrónico existe en la base de datos
$sql = "SELECT id FROM usuarios WHERE correo = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'El correo electrónico no está registrado.';
    header('Location: ' . ruta_forgot_password);  // Redirigir a la página de recuperación
    exit();
}

// Generar un código de verificación de 6 dígitos
$recoveryCode = rand(100000, 999999);

// Guardar el código y el correo electrónico en la sesión para verificar más tarde
$_SESSION['recovery_code'] = $recoveryCode;
$_SESSION['recovery_email'] = $email;

// Opcional: Enviar el código al correo del usuario (Usar PHPMailer, etc.)
// Aquí un ejemplo simple con la función mail (debes configurarlo en tu servidor)
mail($email, "Código de recuperación", "Tu código de verificación es: $recoveryCode");

// Redirigir a la página para verificar el código
header('Location: ' . ruta_verify_code);  // Redirigir a la página de verificación
exit();
