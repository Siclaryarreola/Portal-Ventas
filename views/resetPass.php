<!--inicia la sesión-->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!--contenedor del formulario-->
    <div class="container mt-5">
        <h2 class="text-center">Cambiar Contraseña</h2>
        <p class="text-center">Por favor, ingresa tu nueva contraseña.</p>

            <!-- Verifica si existe un mensaje de error almacenado en la sesión -->
            <?php if (isset($_SESSION['error'])): ?>
                 <!-- Si existe, muestra el mensaje de error dentro de una alerta de Bootstrap de tipo "alert-danger" -->
                 <div class="alert alert-danger">
                     <!-- Imprime el mensaje de error y luego lo elimina de la sesión -->
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                 </div>
            <?php endif; ?>


        <form action="updatePass.php" method="POST">
            <div class="mb-3">
                <label for="new_password" class="form-label">Nueva Contraseña</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Actualizar Contraseña</button>
        </form>
    </div>
</body>
</html>
