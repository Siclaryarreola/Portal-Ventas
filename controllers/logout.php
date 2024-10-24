<?php
session_start();
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión completamente
header('Location: views/login.php'); // Redirigir al formulario de login
exit();
?>
