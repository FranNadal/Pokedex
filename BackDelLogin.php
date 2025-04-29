<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Pokedex/requiereds/requiere.php");

//Conectarse a la BD
$bd= new Database();
$conexion = $bd->getConexion();


// Capturar los datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];


//realizo mi consulta sql
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario' AND contraseña = '$contrasena'";

//almaceno en una variable el resultado de la consulta/query realizada
$resultado = $conexion->query($sql);

//si el resultado arrojo alguna fila
if ($resultado->num_rows > 0) {
    //fila va a almacenar el contenido del resultado en formato array asociativo osea key ---> value
    $fila = $resultado->fetch_assoc();
    /*imprimo el valor de la fila de la key nombre-usuario (EN DESUSO)
    echo "Bienvenido, " . $fila['nombre_usuario']; (EN DESUSO) */

    //Inicializo session_start para enviarle a index.php el nombre de usuario para que pueda usarlo
    session_start();

    // $fila['nombre_usuario'] Contiene el nombre de usuario que ingrese en el login.
    $_SESSION['nombre'] = $fila['nombre_usuario'];
    header("Location: index.php");
    exit();
} else {
echo "usuario o contraseña incorrectos";
}

$conexion->close();




