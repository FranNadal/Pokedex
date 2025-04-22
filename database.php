<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$baseDeDatos = 'pokedex';

$conn = new mysqli($host, $usuario, $contrasena, $baseDeDatos);

// Si hay error, redirige a la página de error
if ($conn->connect_error) {
    header("Location: error.php?message=connection_error");
    exit();
}

echo "Conexión exitosa a la base de datos"; //Para probar
?>
