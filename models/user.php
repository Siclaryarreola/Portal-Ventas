<?php
class User {
    private $users;

    public function __construct() {
        // Usuarios predefinidos con contraseñas hasheadas
        $this->users = [
            'user1@example.com' => [
                'password' => password_hash('password1', PASSWORD_DEFAULT), // Contraseña hasheada
                'name' => 'Usuario Uno'
            ],
            'user2@example.com' => [
                'password' => password_hash('password2', PASSWORD_DEFAULT), // Contraseña hasheada
                'name' => 'Usuario Dos'
            ]
        ];
    }

    // Método para autenticar al usuario
    public function authenticate($email, $password) {
        if (isset($this->users[$email])) {
            // Verifica la contraseña ingresada con el hash almacenado
            if (password_verify($password, $this->users[$email]['password'])) {
                return [
                    'email' => $email,
                    'name' => $this->users[$email]['name']
                ];
            }
        }
        return false;
    }

    // Método para registrar un nuevo usuario
    public function register($name, $email, $password) {
        if (!isset($this->users[$email])) {
            // Hashear la contraseña antes de almacenarla
            $this->users[$email] = [
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'name' => $name
            ];
            return true;
        }
        return false;  // Retorna false si el correo ya está registrado
    }
}
