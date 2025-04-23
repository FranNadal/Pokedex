<?php
// Leer el archivo config.ini
$config = parse_ini_file('config.ini', true); // El segundo parámetro 'true' hace que se devuelvan las secciones
//datos de la base de datos guardados en mi config.ioni
$db_host = $config['database']['host'];
$db_user = $config['database']['user'];
$db_password = $config['database']['password'];
$db_name = $config['database']['database'];

//Conectarse a la BD
$conexion = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

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




