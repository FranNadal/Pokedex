<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/Pokedex/includes/includeGeneral.php');
$numero=$_POST['numero'];
$nombre = $_POST['nombre'];
$tipo1 = $_POST['tipo1'];
if (isset($_POST['tipo2']) && $_POST['tipo2'] !== "") {
    $tipo2 = $_POST['tipo2'];
} else {
    $tipo2 = "NULL"; // sin comillas cuando armás la query
}


$descripcion = $_POST['descripcion'];
$imagen = $_FILES['imagen']['name'];

$bd = new database();
$conexion= $bd->getConexion();

// la carpeta en donde a guardar toda imagen que suba dentro de mi local
$directorio_destino = $_SERVER['DOCUMENT_ROOT'].'/Pokedex/recursos/img/';


// Ruta que se guarda en la base de datos (para mostrar en el navegador)
$ruta_imagen_db = 'recursos/img/' . basename($imagen);

//ruta completa con carpeta + imagen
$ruta_completa_archivo = $directorio_destino . basename($imagen);

//movemos de la carpeta temporal de php a la ruta final en mi local
$rutaTemporal=$_FILES['imagen']['tmp_name'];
//movemos de la carpeta temporal de php a la ruta final en mi local
if(move_uploaded_file($rutaTemporal, $ruta_completa_archivo)){

    // Agregamos comillas simples en los campos de texto para que sea tomado como string y no como consulta a ejecutar
    $sql = "INSERT INTO pokemones (numero, nombre, tipo_id, tipo_id2, descripcion, imagen) 
            VALUES ($numero, '$nombre', $tipo1, $tipo2, '$descripcion', '$ruta_imagen_db')";

if($conexion->query($sql)){
    echo "<script>alert('Pokémon agregado exitosamente'); window.location.href='index.php';</script>";
}else{
    echo "Error al guardar en la base de datos: ";
}

$conexion->close();
}



