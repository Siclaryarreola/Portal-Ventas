<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Ventas</title>

    <!-- Bootstrap para estilos visuales -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet"> <!-- Estilos personalizados -->
</head>
<body>

    <!-- Contenedor principal del login -->
    <div class="login-container">
        <div class="form-section">
            <h2>Portal Ventas</h2>
            <p>Bienvenido a nuestro portal. Por favor, inicia sesión para continuar.</p>

            <!-- Mostrar mensaje de error si existe 
           /* <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?> */
            -->

            <!-- Formulario de login que envía los datos a index.php para ser manejados por el controlador -->
            <form action="index.php?controller=user&action=login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="usuario@drg.mx" required autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="**********" required autocomplete="current-password">
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="recuerdame" id="recuerdame">
                        <label class="form-check-label" for="recuerdame">Recuérdame</label>
                    </div>
                    <a href="#" class="text-decoration-none">Olvidé mi contraseña</a>
                </div>

                <button class="btn btn-primary w-100" type="submit">INGRESAR</button>
            </form>

            <div class="mt-3 text-center">
                <p>¿No tienes una cuenta? <a href="index.php?controller=user&action=register" class="text-decoration-none">Regístrate</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
