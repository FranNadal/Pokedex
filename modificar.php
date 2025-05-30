<?php
//Incluye el arhcivo "includeGeneral" que el mismo incluye el archivo php "database" donde se conecta a la bd
require_once ($_SERVER['DOCUMENT_ROOT'].'/Pokedex/includes/includeGeneral.php');
$bd = new database();
$conexion= $bd->getConexion();

//traigo por url el id del pokemon donde se apreto modificar
$id_pokemon_a_modificar = $_GET['id'];

//traer al pokemon con el id que se apreto en el index
$sql_pokemon= "SELECT * FROM pokemones WHERE numero = $id_pokemon_a_modificar";
//almaceno el resultado de la query en una variable
$resultado_pokemon=$conexion->query($sql_pokemon);

//lo vuelvo un array asociativo es decir key ---> value
$pokemon = $resultado_pokemon->fetch_assoc();


//LE ASIGNO EL NOMBRE(EJ: PLANTA) AL TIPO(EJ: #1) DE POKEMON
//accedo al tipoid de mi pokemon traido por get
$idTipo = $pokemon['tipo_id'];

//dame el nombre de la tabla tipo donde el id sea el idtipo del pokemon hago esta consulta para que en vez de aparecer 3 figure agua
$sql_tipo = "SELECT nombre FROM tipos WHERE id = $idTipo";

//almaceno la query en una variable
$resultadoTipo = $conexion->query($sql_tipo);

//inicializo esta variable globalmente para dps usarla abajo
$nombreTipo = "";

//vuelvo resultado un array asociativo para poder acceder al valor por la key "nombre"
    $fila=$resultadoTipo->fetch_assoc();

    $nombreTipo = $fila['nombre'];


 //LE ASIGNO EL NOMBRE (EJ: PLANTA) AL 2DO TIPO DE POKEMON. ES OPCIONAL, PUEDE TENER 2 TIPOS O NO.
$nombreTipo2 = ""; // inicialización
//si el tipo2 tiene algun contenido procedo  a ejecutar la consulta
if (!empty($pokemon['tipo_id2'])) {
    $idTipo2 = $pokemon['tipo_id2'];
    $sql = "SELECT nombre FROM tipos WHERE id = $idTipo2";
    $resultado2 = $conexion->query($sql);

        $fila = $resultado2->fetch_assoc();
        $nombreTipo2 = $fila['nombre'];

}


//si se mando el formulario
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $tipo1 = null;

    if (isset($_POST['tipo1'])) {
        $tipo1 = (int) $_POST['tipo1'];
    }



    $nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$tipo2 = "NULL";
    if (isset($_POST['tipo2']) && $_POST['tipo2'] !== "") {
        $tipo2 = $_POST['tipo2'];
    }
    $nuevaImagen=$_FILES['imagen']['name'];
// la carpeta en donde a guardar toda imagen que suba dentro de mi local
    $directorio_destino = $_SERVER['DOCUMENT_ROOT'].'/Pokedex/recursos/img/';


// Ruta que se guarda en la base de datos (para mostrar en el navegador)
    $ruta_imagen_db = 'recursos/img/' . basename($pokemon['imagen']);

//ruta completa con carpeta + imagen
    $ruta_completa_archivo = $directorio_destino . basename($nuevaImagen);

    if(!empty($nuevaImagen)){
        move_uploaded_file($_FILES['imagen']['tmp_name'],   $ruta_completa_archivo);
        $ruta_imagen_db = 'recursos/img/' . basename($nuevaImagen);
        }

    $sqlUpdate="UPDATE pokemones 
            SET nombre = '$nombre', 
                tipo_id = $tipo1, 
                tipo_id2 = $tipo2, 
                descripcion = '$descripcion', 
                imagen = '$ruta_imagen_db'
            WHERE numero = $id_pokemon_a_modificar";

    if($conexion->query($sqlUpdate)){
        echo "<script>alert('Pokémon modificado exitosamente'); window.location.href='index.php';</script>";
    }else{
        echo "Error al guardar en la base de datos: ";
    }

}
$conexion->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Pokémon</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./FrontEnd/estilos.css">
    <link rel="stylesheet" href="./FrontEnd/home_page.css">
</head>


<body>

<!-- NAVBAR -->
<div class="navbar">
    <a href="index.php">
        <img src="./FrontEnd/img/logo_pokemon.png" alt="Pokeball">
    </a>
</div>

<h2 class="w3-text-red">Modificar Pokémon</h2>

<form class="w3-container" method="post" enctype="multipart/form-data">
    <label class="w3-text-red"><b>Nombre</b></label>
    <input class="w3-input w3-border" type="text" name="nombre" value="<?= $pokemon['nombre'] ?>" required>

    <label class="w3-text-red"><b>Tipo 1</b></label>
    <select class="w3-select w3-border" name="tipo1" required>
        <option value="<?= $pokemon['tipo_id'] ?>" selected><?= $nombreTipo ?></option>
        <option value="1">Planta</option>
        <option value="2">Fuego</option>
        <option value="3">Agua</option>
        <option value="4">Eléctrico</option>
        <option value="5">Psíquico</option>
        <option value="6">Hielo</option>
        <option value="7">Roca</option>
        <option value="8">Bicho</option>
        <option value="9">Fantasma</option>
        <option value="10">Dragón</option>
        <option value="11">Volador</option>
        <option value="12">Normal</option>
        <option value="13">Lucha</option>
        <option value="14">Veneno</option>
        <option value="15">Tierra</option>
    </select>

    <label class="w3-text-red"><b>Tipo 2 (opcional)</b></label>
    <select class="w3-select w3-border" name="tipo2">
        <option value="<?= $pokemon['tipo_id2'] ?>" selected><?= $nombreTipo2 ?></option>
        <option value="">Ninguno</option>
        <option value="1">Planta</option>
        <option value="2">Fuego</option>
        <option value="3">Agua</option>
        <option value="4">Eléctrico</option>
        <option value="5">Psíquico</option>
        <option value="6">Hielo</option>
        <option value="7">Roca</option>
        <option value="8">Bicho</option>
        <option value="9">Fantasma</option>
        <option value="10">Dragón</option>
        <option value="11">Volador</option>
        <option value="12">Normal</option>
        <option value="13">Lucha</option>
        <option value="14">Veneno</option>
        <option value="15">Tierra</option>
    </select>

    <label class="w3-text-red"><b>Descripción</b></label>
    <textarea class="w3-input w3-border" name="descripcion"><?= $pokemon['descripcion'] ?></textarea>

    <label class="w3-text-red"><b>Imagen</b></label>
    <input class="w3-input w3-border" type="file" name="imagen">

    <p class="w3-text-red"><b>Imagen actual:</b></p>
    <img src="/Pokedex/<?= $pokemon['imagen'] ?>" alt="Imagen Pokémon" style="width: 150px;">
    <br><br>

    <button class="w3-button w3-red" type="submit">Guardar Cambios</button>
</form>

</body>
</html>
