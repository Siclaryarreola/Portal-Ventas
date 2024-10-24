<!-- Inicia la sesión para manejar los datos de sesión como el código de verificación -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
    <!-- Cargar Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal para el formulario de verificación del código -->
    <div class="container mt-5">
        <h2 class="text-center">Verificar Código</h2>
        <p class="text-center">Por favor, ingresa el código de verificación que recibiste en tu correo.</p>

        <!-- Mostrar mensaje de error si existe un error guardado en la sesión -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <!-- Mostrar el error y luego eliminarlo de la sesión -->
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para ingresar el código de verificación -->
        <form action="checkCode.php" method="POST">
            <div class="mb-3">
                <!-- Campo para que el usuario ingrese el código que recibió por correo -->
                <label for="recovery_code" class="form-label">Código de Verificación</label>
                <input type="text" name="recovery_code" id="recovery_code" class="form-control" required>
            </div>
            <!-- Botón para enviar el código e intentar verificarlo -->
            <button type="submit" class="btn btn-primary w-100">Verificar Código</button>
        </form>
    </div>
</body>
</html>
