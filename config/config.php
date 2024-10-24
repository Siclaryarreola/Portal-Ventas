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

//Rutas absolutas a configuración (config)
define('ruta_config', RUTA_BASE . 'config/config.php');
define('ruta_database', RUTA_BASE . 'config/database.php');

// Rutas absolutas a vistas (views)
define('ruta_login', RUTA_BASE . 'views/user/login.php');
define('ruta_register', RUTA_BASE . 'views/user/register.php');
define('ruta_forgotPass', RUTA_BASE . 'views/user/forgotPass.php');
define('ruta_resetPass', RUTA_BASE . 'views/user/resetPass.php');
define('ruta_verifyCode', RUTA_BASE . 'views/user/verifyCode.php');
define('ruta_dashboardAdmin', RUTA_BASE . 'views/admin/dashboardAdmin.php');
define('ruta_dashboardUser', RUTA_BASE . 'views/user/dashboardUser.php');

// Rutas absolutas a controladores (controllers)
define('ruta_userController', RUTA_BASE . 'controllers/userController.php');
define('ruta_checkCode', RUTA_BASE . 'controllers/checkCode.php');
define('ruta_sendCode', RUTA_BASE . 'controllers/sendCode.php');
define('ruta_updatePass', RUTA_BASE . 'controllers/updatePass.php');
define('ruta_verificarHash', RUTA_BASE . 'controllers/verificarHash.php');
define('ruta_hash', RUTA_BASE . 'controllers/hash.php');

// Rutas absolutas a modelos (models)
define('ruta_userModel', RUTA_BASE . 'models/userModel.php');

// Rutas absolutas a recursos públicos (public)
define('ruta_css', RUTA_BASE . 'public/css/');
define('ruta_images', RUTA_BASE . 'public/images/');


