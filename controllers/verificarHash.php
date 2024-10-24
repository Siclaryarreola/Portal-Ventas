<?php
$password_ingresada = '12345678';
$password_almacenada = '$2y$10$gRMYkoy7SVzwAxteOwzNF.k4.v.gFuvgm7v7P.jZAx/NXO7GDUHMC'; // Hash de la base de datos

if (password_verify($password_ingresada, $password_almacenada)) {
    echo "La contraseña es correcta.";
} else {
    echo "La contraseña es incorrecta.";
}

