<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Pokedex/includes/includeGeneral.php');
session_start();

$db = new database();
$conexion = $db->getConexion();

$numero = $_GET['numero'];  // Obtener el número del Pokémon desde la URL

$sql = "SELECT 
            p.numero, 
            p.nombre, 
            p.descripcion, 
            p.imagen, 
            t1.imagen AS tipo_imagen1, 
            t2.imagen AS tipo_imagen2 
        FROM pokemones p
        LEFT JOIN tipos t1 ON p.tipo_id = t1.id
        LEFT JOIN tipos t2 ON p.tipo_id2 = t2.id
        WHERE p.numero = $numero";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokémon - Información</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="./FrontEnd/estilos.css">
    <link rel="stylesheet" href="./FrontEnd/home_page.css">
    <link rel="stylesheet" href="./FrontEnd/info_pokemon.css">
    <link rel="stylesheet" href="./FrontEnd/responsive_table.css">


</head>
<body>
<?php
// Mostrar mensaje de eliminación si es necesario
if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'eliminado') {
    echo '<div class="w3-panel w3-green w3-display-container">
                <span onclick="this.parentElement.style.display=\'none\'" class="w3-button w3-large w3-display-topright">&times;</span>
                Pokémon eliminado correctamente.
              </div>';
}
?>

<!-- NAVBAR -->
<div class="navbar">
    <a href="index.php">
        <img src="./FrontEnd/img/logo_pokemon.png" alt="Pokeball">
    </a>
    <div class="username">
        <?php
        // Mostrar el nombre del usuario si está logueado
        if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
            $nombre = $_SESSION['nombre'];
            echo '<div class="dropdown-hover right">';
            echo '  <button class="button custom-button">';
            echo '    👤 Hola, <strong>' . $nombre . '</strong>';
            echo '  </button>';
            echo '  <div class="dropdown-content bar-block card-4 animate-opacity">';
            echo '    <a href="cerrarSesion.php" class="bar-item custom-link button hover-red">🔒 Cerrar Sesión</a>';
            echo '  </div>';
            echo '</div>';
        } else {
            echo '<a id="link-login" href="login.php">Iniciar sesión</a>';
        }
        ?>
    </div>
</div>

<!-- INFO POKÉMON -->
<div class="contenedor-central">
    <div class="info-pokemon">
        <?php
        // Mostrar la info de la base de datos (Perfil pokemon)
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();

            echo '<div class="imagen-pokemon">';
            echo "<img src='{$fila['imagen']}' alt='{$fila['nombre']}' width='400'>";
            echo '</div>';

            echo '<div class="datos-pokemon">';

            echo "<h1>{$fila['nombre']}</h1>"; //Ver nombre pokemon
            echo "<p><strong>Descripción:</strong> {$fila['descripcion']}</p>"; // Titulo descripcion
            //////////////
            echo "<div class='tipos'>";

            echo "<img src='{$fila['tipo_imagen1']}' alt='Tipo 1' width='100'>";
            if (!empty($fila['tipo_imagen2'])) {
                echo "<img src='{$fila['tipo_imagen2']}' alt='Tipo 2' width='100'>";
            }

            echo "</div>";
            ?>

            <!-- Un voton para regresar al index -->
            <div>
                <a href="index.php" class="boton-personalizado">
                    Volver al inicio
                </a>
            </div>

            <?php
            echo '</div>';
        } else {
            echo "<p>Pokémon no encontrado.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>

<?php
// Cerrar la conexión con la base de datos
$conexion->close();
?>
