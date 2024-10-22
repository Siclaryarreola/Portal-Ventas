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
        $sql = "SELECT id, correo, contraseña, rol FROM usuarios WHERE correo = ?"; // Consulta SQL para buscar al usuario por correo
        $stmt = $this->db->prepare($sql); // Prepara la consulta SQL para evitar inyecciones SQL

        // Depuración: Verificar si la consulta fue preparada correctamente
        if ($stmt === false) {
            echo "Error al preparar la consulta SQL: " . $this->db->error . "\n";
            error_log("Error al preparar la consulta SQL: " . $this->db->error);
            return false; // Devuelve false si ocurre un error
        }

        $stmt->bind_param("s", $email); // Vincula el parámetro email a la consulta SQL
        $stmt->execute(); // Ejecuta la consulta
        $result = $stmt->get_result(); // Obtiene el resultado de la consulta

        // Depuración: Verificar si se obtuvo algún resultado
        if ($result->num_rows === 0) {
            echo "No se encontró ningún usuario con el correo: $email\n";
            error_log("No se encontró ningún usuario con el correo: $email");
            return 'no_user';  // Devuelve 'no_user' si no se encuentra el usuario
        }

        $user = $result->fetch_assoc(); // Obtiene los datos del usuario como un array asociativo

        // Depuración: Verificar si se obtuvieron los datos del usuario correctamente
        echo "Datos del usuario obtenidos:\n";
        print_r($user); // Mostrar los datos del usuario para depuración
        error_log("Datos del usuario obtenidos: " . print_r($user, true));

        // Verifica si la contraseña proporcionada es válida
        if ($user && !password_verify($password, $user['contraseña'])) {
            echo "Contraseña incorrecta para el correo: $email\n";
            error_log("Contraseña incorrecta para el correo: $email");
            return 'wrong_password';  // Devuelve 'wrong_password' si la contraseña es incorrecta
        }

        // Depuración: La autenticación fue exitosa
        echo "Autenticación exitosa para el usuario con correo: $email\n";
        error_log("Autenticación exitosa para el usuario con correo: $email");

        return $user;  // Retorna el array completo del usuario si las credenciales son correctas
    }

    // Método para crear un nuevo usuario en la base de datos
    public function createUser($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Encripta la contraseña antes de almacenarla en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, 1)"; // Consulta SQL para insertar el nuevo usuario, con el rol por defecto como '1' (usuario regular)
        $stmt = $this->db->prepare($sql); // Prepara la consulta SQL

        // Depuración: Verificar si la consulta fue preparada correctamente
        if ($stmt === false) {
            echo "Error al preparar la consulta SQL: " . $this->db->error . "\n";
            error_log("Error al preparar la consulta SQL: " . $this->db->error);
            return false; // Devuelve false si ocurre un error
        }

        $stmt->bind_param("sss", $name, $email, $hashedPassword); // Vincula los parámetros a la consulta SQL
        $stmt->execute(); // Ejecuta la consulta con los valores proporcionados

        // Depuración: Verificar si el usuario fue creado correctamente
        if ($stmt->affected_rows > 0) {
            echo "Usuario creado exitosamente con ID: " . $this->db->insert_id . "\n";
            error_log("Usuario creado exitosamente con ID: " . $this->db->insert_id);
            return $this->db->insert_id; // Devuelve el ID del usuario recién creado
        } else {
            echo "Error al crear el usuario: " . $this->db->error . "\n";
            error_log("Error al crear el usuario: " . $this->db->error);
            return false; // Devuelve false si ocurre un error
        }
    }
}
