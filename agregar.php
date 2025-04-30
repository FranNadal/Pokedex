<?php
//Incluye el arhcivo "includeGeneral" que el mismo incluye el archivo php "database" donde se conecta a la bd
require_once ($_SERVER['DOCUMENT_ROOT'].'/Pokedex/includes/includeGeneral.php');
$bd = new database();
$conexion= $bd->getConexion();

//Parametros recibidos del formulario "agregar". Se le asiga una variable a cada valor.
$numero=$_POST['numero'];
$nombre = $_POST['nombre'];
$tipo1 = $_POST['tipo1'];
//Al ser opcional tener dos tipos, se hace una consulta antes para verificar si esta vacio o no.
if (isset($_POST['tipo2']) && $_POST['tipo2'] !== "") {
    $tipo2 = $_POST['tipo2'];
} else {
    $tipo2 = "NULL"; // sin comillas cuando armás la query
}
$descripcion = $_POST['descripcion'];
$imagen = $_FILES['imagen']['name'];


// la carpeta en donde a guardar toda imagen que suba dentro de mi local
$directorio_destino = $_SERVER['DOCUMENT_ROOT'].'/Pokedex/recursos/img/';
$ruta_completa_archivo = $directorio_destino . basename($imagen); //ruta completa con carpeta + imagen

// Ruta que se guarda en la base de datos en formato String (para mostrar en el navegador)
$ruta_imagen_db = 'recursos/img/' . basename($imagen);


//movemos los datos de la carpeta temporal de php a la ruta final en mi local
$rutaTemporal=$_FILES['imagen']['tmp_name'];
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



