<?php
require_once(__DIR__ . '/../models/userModel.php'); // Ruta absoluta correcta al modelo


class userController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    //Muestra el login 
    public function showLoginForm() 
    {
        require('views/login.php'); 
    }
    public function login() 
    {
        if (session_status() === PHP_SESSION_NONE) 
        {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validar formato del correo electrónico
            if (!preg_match('/^[a-zA-Z0-9._-]+@drg\.mx$/', $email)) 
            {
                $_SESSION['error'] = 'El correo electrónico debe terminar en @drg.mx.';
                header('Location: index.php');  // Regresa al login si hay error
                exit();
            }

            // Validar formato de la contraseña (mínimo 8 caracteres, sin espacios)
            if (strlen($password) < 8 || !preg_match('/^[A-Za-z0-9!@#$%^&*()_+=-]+$/', $password))
            {
                $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres y solo puede contener letras, números y símbolos permitidos.';
                header('Location: index.php');  // Regresa al login si hay error
                exit();
            }

            // Autenticar al usuario
            $user = $this->userModel->getUserByEmail($email, $password);

            // Verificar si se obtuvo un array válido con el usuario
            if (is_array($user)) 
            {
                $_SESSION['user'] = $user;  // Guardar el usuario en la sesión
                $_SESSION['nombre'] = $user['nombre'];

                // Verificar el rol del usuario y redirigir a la página correspondiente
                if ($user['rol'] === 1) 
                {
                    header('Location: /Portal-Ventas/views/admin/dashboardAdmin.php');  // Ruta absoluta al dashboard admin
                } else 
                {
                    header('Location: /Portal-Ventas/views/user/dashboarUser.php');  // Ruta absoluta al dashboard usuario
                }
                
                exit();
            } else {
                // Si las credenciales no son correctas
                $_SESSION['error'] = 'Correo electrónico o contraseña incorrectos';
                header('Location: index.php');  // Ruta absoluta al login
                exit();
            }
        }
    }
    public function showRegistrationForm() 
    {
        require(__DIR__ . '/../views/register.php');  // Ruta relativa 
    }
    
    //función para crear una cuenta
    public function createAccount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Intentar registrar al usuario
            $result = $this->userModel->createUser($nombre, $email, $password);

            if ($result) 
            {
                $_SESSION['success'] = 'Cuenta creada exitosamente.';
                header('Location: index.php');  // Ruta absoluta al login
            }
            else 
            {
                $_SESSION['error'] = 'El correo ya está registrado.';
                header('Location: index.php?controller=user&action=register');  // Redirigir al registro
            }
            exit();
        }
    }

    //Función para cerrar la sesión
    public function logout() 
    {
        if (session_status() === PHP_SESSION_NONE) 
        {
            session_start();
        }
        session_destroy();  // Destruir la sesión
        header('Location: index.php');  // Ruta absoluta al login
        exit();
    }
}
