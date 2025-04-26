<?php
// Iniciar la sesión para mostrar el nombre de usuario si está logueado
session_start();

// Leer el archivo config.ini
$config = parse_ini_file('config.ini', true); // El segundo parámetro 'true' hace que se devuelvan las secciones
$db_host = $config['database']['host'];
$db_user = $config['database']['user'];
$db_password = $config['database']['password'];
$db_name = $config['database']['database'];

// Conectarse a la base de datos
$conexion = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los Pokémon y sus tipos (si se ha enviado una búsqueda por nombre)
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT p.numero, p.nombre, t.imagen AS tipo_imagen, p.descripcion, p.imagen
        FROM pokemones p
        JOIN tipos t ON p.tipo_id = t.id
        WHERE p.nombre LIKE '%$search%'"; //Si no pongo nada, no busca como si no hubiera criterio de busqueda

// Ejecutar la consulta
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokédex Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="./FrontEnd/estilos.css">
    <link rel="stylesheet" href="./FrontEnd/home_page.css">

    <style>
        /* Estilo para el contenedor de la barra de búsqueda y el botón */
        .search-box {
            display: flex;
            align-items: center; /* Centra el contenido verticalmente */
        }

        /* Estilo para que el campo de texto ocupe todo el espacio disponible */
        .search-box input {
            flex: 1;
            margin-right: 10px; /* Añadir un margen entre el campo de búsqueda y el botón */
        }

        /* Estilo opcional para el botón */
        .search-box button {
            flex-shrink: 0; /* Evita que el botón se reduzca */
        }

        .search-box button:hover {
            box-shadow: none; /* Elimina la sombra al pasar el mouse */
        }

        /* Lineas fila y columnas */
        table.w3-table-all td, table.w3-table-all th {
            border-right: 2px solid #ddd;
        }

        table.w3-table-all td:last-child, table.w3-table-all th:last-child {
            border-right: none;
        }


    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <img src="./FrontEnd/img/logo_pokemon.png" alt="Pokeball">
    <div class="username">
        <?php
        // Mostrar el nombre del usuario logueado
        if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
            // Mostrar el nombre del usuario si está logueado
            $nombre = $_SESSION['nombre'];
            echo "Hola, $nombre";
        } else {
            // Si no está logueado o el nombre está vacío, mostrar el mensaje para iniciar sesión
            echo "Iniciar sesión";
        }
        ?>
    </div>
</div>

<!-- SEARCH BAR -->
<div class="search-container w3-container">
    <form method="GET" action="index.php"> <!-- Método GET para enviar datos en la URL -->
        <div class="search-box">
            <input class="w3-input w3-round w3-border"
                   type="text"
                   name="search"
                   placeholder="Buscar por Pokémon o ID"
                   value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="w3-btn w3-red w3-round" type="submit">Buscar</button>
        </div>
    </form>
</div>

<!-- TABLE SPACE -->
<div class="table-container w3-container w3-card-4">
    <h3>Pokédex</h3>
    <table class="w3-table-all w3-hoverable">
        <thead>
        <tr class="w3-light-grey">
            <th>#</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Imagen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Mostrar resultados
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                <td>{$fila['numero']}</td>
                <td>{$fila['nombre']}</td>
                <td><img src='{$fila['tipo_imagen']}' alt='tipo' width='50'></td>
                <td>{$fila['descripcion']}</td>
                <td><img src='{$fila['imagen']}' alt='{$fila['nombre']}' width='60'></td>
              </tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron Pokémon.";
        }

        ?>
        </tbody>
</div>

</body>
</html>

<?php
// Cerrar la conexión con la base de datos
$conexion->close();
?>
