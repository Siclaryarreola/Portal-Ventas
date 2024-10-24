<?php
// Define la constante 'DB_HOST' es la dirección IP local o localhost.
define('DB_HOST', '127.0.0.1');

// Define la constante 'DB_' es el nombre de la base de datos que se usará.
define('DB_NAME', 'sisventas');

// Define la constante 'DB_USER' es el nombre de usuario comúnmente usado para acceso administrativo a MySQL.
define('DB_USER', 'root');

// Define la constante 'DB_PASSWORD' , es la contraseña 

define('DB_PASSWORD', '');


// Ruta base del proyecto
define('RUTA_BASE', __DIR__ . '/');  // Directorio raíz del proyecto

// Rutas absolutas a vistas (views)
define('ruta_login', RUTA_BASE . 'views/user/login.php');
define('ruta_register', RUTA_BASE . 'views/user/register.php');
define('ruta_forgot_password', RUTA_BASE . 'views/user/forgotPass.php');
define('ruta_reset_password', RUTA_BASE . 'views/user/resetPass.php');
define('ruta_verify_code', RUTA_BASE . 'views/user/verifyCode.php');
define('ruta_dashboard_admin', RUTA_BASE . 'views/admin/dashboardAdmin.php');
define('ruta_dashboard_user', RUTA_BASE . 'views/user/dashboardUser.php');

// Rutas absolutas a controladores (controllers)
define('ruta_controlador_user', RUTA_BASE . 'controllers/userController.php');
define('ruta_controlador_check_code', RUTA_BASE . 'controllers/checkCode.php');
define('ruta_controlador_send_code', RUTA_BASE . 'controllers/sendCode.php');
define('ruta_controlador_update_pass', RUTA_BASE . 'controllers/updatePass.php');
define('ruta_controlador_verificar_hash', RUTA_BASE . 'controllers/verificarHash.php');
define('ruta_controlador_hash', RUTA_BASE . 'controllers/hash.php');

// Rutas absolutas a modelos (models)
define('ruta_modelo_user', RUTA_BASE . 'models/userModel.php');

// Rutas absolutas a recursos públicos (public)
define('ruta_css', RUTA_BASE . 'public/css/');
define('ruta_images', RUTA_BASE . 'public/images/');


