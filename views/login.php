
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

            <!-- Mostrar mensaje de error si existe -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"> <!--Estilos de bootstrap-->
                    <!-- Mensaje de error almacenado en la sesión -->

                    <?php echo $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); // Eliminar el mensaje de error después de mostrarlo ?>
            <?php endif; ?>

            <!-- Formulario de login que envía los datos a index.php para ser manejados por el controlador -->
            <form id="loginForm" action="index.php?controller=user&action=login" method="POST">
                <!-- Campo de entrada para el correo electrónico -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="usuario@drg.mx" required autocomplete="username">
                </div>
                <!-- Campo de entrada para la contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="**********" required autocomplete="current-password">
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <!-- Opción para recordar al usuario -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="recuerdame" id="recuerdame">
                        <label class="form-check-label" for="recuerdame">Recuérdame</label>
                    </div>
                    <!-- Enlace de "Olvidé mi contraseña" -->
                    <a href="#" class="text-decoration-none">Olvidé mi contraseña</a>
                </div>

                <!-- Botón para enviar el formulario -->
                <button class="btn btn-primary w-100" type="submit">INGRESAR</button>
            </form>

            <div class="mt-3 text-center">
                <p>¿No tienes una cuenta? <a href="index.php?controller=user&action=register" class="text-decoration-none">Regístrate</a></p>
            </div>
        </div>
    </div>

    <!-- Validación de formulario en JavaScript -->
    <script>
        // Agregar un evento para validar el formulario antes de enviarlo
        document.getElementById('loginForm').addEventListener('submit', function(event) 
        {
            const email = document.getElementById('email').value;  // Captura el valor del email ingresado
            const password = document.getElementById('password').value;  // Captura el valor de la contraseña ingresada

            // Verificar si el correo tiene el dominio correcto (@drg.mx)
            const emailPattern = /^[a-zA-Z0-9._-]+@drg\.mx$/;  // Expresión regular para validar el dominio del correo
            if (!emailPattern.test(email)) 
            {
                alert('El correo electrónico debe terminar en @drg.mx.');  // Muestra un error si no es válido
                event.preventDefault();  // Evitar el envío del formulario
                return;
            }

            // Verificar si la contraseña es válida (al menos 8 caracteres, sin espacios, solo ciertos símbolos)
            const passwordPattern = /^[A-Za-z0-9!@#$%^&*()_+=-]+$/;  // Expresión regular para validar caracteres permitidos
            if (password.length < 8)
             {
                alert('La contraseña debe tener al menos 8 caracteres.');  // Muestra un error si es demasiado corta
                event.preventDefault();  // Evitar el envío del formulario
                return;
            }
            if (!passwordPattern.test(password))
             {
                alert('La contraseña solo puede contener letras, números y símbolos permitidos (!@#$%^&*()_+=-). No se permiten espacios.');  // Error si contiene caracteres no permitidos o espacios
                event.preventDefault();  // Evitar el envío del formulario
                return;
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
