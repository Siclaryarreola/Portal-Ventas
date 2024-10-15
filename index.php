<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Ventas</title>

    <!-- redireccion a bootstrap y al documento de diseño-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
</head>
<body>

<!--almacena todo el contendor del login, incluyendo la imagen -->
    <div class="login-container">
        <!-- Sección de la imagen, el diseño lo tiene en el css-->
        <div class="image-section"></div>

        <!-- Sección del formulario de login -->
        <div class="form-section">
            <h2>Portal Ventas</h2>
            <p>Bienvenido a nuestro portal. Por favor, inicia sesión para continuar.</p>

            <!-- toma los datos ingresados y con metodo post los envia al 
             userController para manejar la peticion y mostrar una vista -->
            <form action="index.php?controller=user&action=login" method="POST">
                <div class="mb-3">

                <!--Atributos del contenedor Correo electrónico y contraseña-->
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="usuario@drg.mx" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="**********" required>
                </div>

                <!-- Creacion de checkbox recuérdame y opcion para recuperar contraseña-->
                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="recuerdame" id="recuerdame">
                        <label class="form-check-label" for="recuerdame">Recuérdame</label>
                    </div>
                    <a href="#" class="text-decoration-none">Olvidé mi contraseña</a>
                </div>
                <!-- Creación y diseño del boton inciar sesion con la accion de enviar, 
                 envia los datos ingresados al documento userController-->
                <button class="btn btn-primary w-100" type="submit">INGRESAR</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


