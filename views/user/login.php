
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Business Landing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #00A9B8, #005f73);
        }
        .login-container {
            display: flex;
            width: 900px;
            height: 500px;
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        }
        .image-section {
            flex: 1;
            background: url('/assets/images/banner.jpg') no-repeat center center;
            background-size: cover;
        }
        .form-section {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-section h2 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #005f73;
        }
        .form-section p {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 30px;
        }
        .form-section .btn-primary {
            background-color: #005f73;
            border-color: #005f73;
            padding: 10px 20px;
        }
        .form-section .btn-primary:hover {
            background-color: #00A9B8;
            border-color: #00A9B8;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Sección de la imagen -->
    <div class="image-section"></div>

    <!-- Sección del formulario -->
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
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>
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
