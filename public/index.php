
session_start();
require '../config/database.php'; // Si necesitas conexión a base de datos
require '../controllers/UserController.php';
require '../models/User.php';

// Enrutador básico
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'UserController';
$action = isset($_GET['action']) ? $_GET['action'] : 'showLoginForm';

$controller = new $controllerName();
$controller->$action();
