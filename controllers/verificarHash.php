<?php
$password_ingresada = '1234';
$password_almacenada = '$2y$10$IIdaoEv6jzPGYerJDXWpUu/aY2Xx8ftDZuERZ0YOuGE2V1m.SnT7.'; // Hash de la base de datos

if (password_verify($password_ingresada, $password_almacenada)) {
    echo "La contraseña es correcta.";
} else {
    echo "La contraseña es incorrecta.";
}

