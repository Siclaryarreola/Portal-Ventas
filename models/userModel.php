<?php
require_once('config/database.php'); // Incluye el archivo que gestiona la conexión a la base de datos

class UserModel {
    private $db; // Variable privada para almacenar la conexión a la base de datos

    // Constructor que inicializa la conexión a la base de datos cuando se crea una instancia de UserModel
    public function __construct() {
        $this->db = Database::getInstance()->getConnection(); // Obtiene la instancia única de la conexión a la base de datos usando el patrón Singleton
    }
    
    // Método para validar la existencia de un usuario por su correo electrónico y verificar la contraseña
    public function getUserByEmail($email, $password) {
        $sql = "SELECT id, correo, contraseña, rol, intentos_fallidos, ultimo_intento FROM usuarios WHERE correo = ?";
        $stmt = $this->db->prepare($sql); // Prepara la consulta SQL para evitar inyecciones SQL

        // Verificar si la consulta fue preparada correctamente
        if ($stmt === false) {
            error_log("Error al preparar la consulta SQL: " . $this->db->error);
            return false; // Devuelve false si ocurre un error
        }

        $stmt->bind_param("s", $email); // Vincula el parámetro email a la consulta SQL
        $stmt->execute(); // Ejecuta la consulta
        $result = $stmt->get_result(); // Obtiene el resultado de la consulta

        // Verificar si se obtuvo algún resultado
        if ($result->num_rows === 0) {
            error_log("No se encontró ningún usuario con el correo: $email");
            return false;  // Devuelve false si no se encuentra el usuario
        }

        $user = $result->fetch_assoc(); // Obtiene los datos del usuario como un array asociativo

        // Limitar intentos de inicio de sesión fallidos
        if ($user['intentos_fallidos'] >= 3) {
            $currentTime = new DateTime();
            $lastAttempt = new DateTime($user['ultimo_intento']);
            $interval = $currentTime->diff($lastAttempt);

            // Verificar si han pasado menos de 30 minutos
            if ($interval->i < 30) {
                error_log("Usuario bloqueado temporalmente debido a demasiados intentos fallidos: $email");
                return 'user_blocked';  // Devuelve 'user_blocked' si el usuario está bloqueado temporalmente
            }
        }

        // Verificar la contraseña
        if (!password_verify($password, $user['contraseña'])) {
            // Incrementar intentos fallidos y actualizar la última fecha de intento
            $this->incrementFailedAttempts($email);
            error_log("Contraseña incorrecta para el correo: $email");
            return 'wrong_password';
        }

        // Si la autenticación es exitosa, restablecer los intentos fallidos
        $this->resetFailedAttempts($email);

        // Retornar los datos del usuario
        error_log("Autenticación exitosa para el usuario con correo: $email");
        return $user;
    }

    // Método para incrementar los intentos fallidos y registrar la hora del último intento
    private function incrementFailedAttempts($email) {
        $sql = "UPDATE usuarios SET intentos_fallidos = intentos_fallidos + 1, ultimo_intento = NOW() WHERE correo = ?";
        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            error_log("Error al preparar la consulta SQL para incrementar intentos: " . $this->db->error);
            return false;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
    }

    // Método para restablecer los intentos fallidos después de un inicio de sesión exitoso
    private function resetFailedAttempts($email) {
        $sql = "UPDATE usuarios SET intentos_fallidos = 0, ultimo_intento = NULL WHERE correo = ?";
        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            error_log("Error al preparar la consulta SQL para restablecer intentos: " . $this->db->error);
            return false;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
    }

    // Método para crear un nuevo usuario en la base de datos
    public function createUser($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Encripta la contraseña antes de almacenarla en la base de datos

        // Consulta SQL para insertar el nuevo usuario, con el rol por defecto como '1' (usuario regular)
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, 0)"; 
        $stmt = $this->db->prepare($sql); // Prepara la consulta SQL

        // Verificar si la consulta fue preparada correctamente
        if ($stmt === false) {
            error_log("Error al preparar la consulta SQL: " . $this->db->error);
            return false; // Devuelve false si ocurre un error
        }

        // Vincula los parámetros a la consulta SQL
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        $stmt->execute(); // Ejecuta la consulta con los valores proporcionados

        // Verificar si el usuario fue creado correctamente
        if ($stmt->affected_rows > 0) {
            error_log("Usuario creado exitosamente con ID: " . $this->db->insert_id);
            return $this->db->insert_id; // Devuelve el ID del usuario recién creado
        } else {
            error_log("Error al crear el usuario: " . $this->db->error);
            return false; // Devuelve false si ocurre un error
        }
    }
}
