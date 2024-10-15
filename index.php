<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <!-- Sección de la imagen -->
        <div class="image-section"></div>

        <!-- Sección del formulario de login -->
        <div class="form-section">
            <h2>Portal Ventas</h2>
            <p>Bienvenido a nuestro portal. Por favor, inicia sesión para continuar.</p>
            <form action="index.php?controller=user&action=login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="usuario@drg.mx" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="**********" required>
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>