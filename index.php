<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/Pokedex/includes/includeGeneral.php');
// Iniciar la sesión para mostrar el nombre de usuario si está logueado
session_start();

$db= new database();



// Conectarse a la base de datos
$conexion = $db->getConexion();


// Consulta SQL para obtener los Pokémon y sus tipos (si se ha enviado una búsqueda por nombre)
$search = isset($_GET['search']) ? $_GET['search'] : '';
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
        WHERE p.nombre LIKE '%$search%'";


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
            // Mostrar un link para iniciar sesión si no está logueado
            echo '<a id="link-login" href="login.php">Iniciar sesión</a>';
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
                   placeholder="Buscar por Pokémon"
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
            <?php
            //si esta la sesion inicada se va agregar un boton a la columna con la funcion de agregar
            if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {

                //
                echo "<th>
          <a href='#' onclick=\"document.getElementById('modalAgregar').style.display='block'\">
            <button>Agregar</button>
          </a>
        </th>";
            }
            ?>
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
            <td style='text-align: center;'>
                <img src='{$fila['tipo_imagen1']}' alt='Tipo 1' width='70'>";
                if (!empty($fila['tipo_imagen2'])) {
                    echo "<img src='{$fila['tipo_imagen2']}' alt='Tipo 2' width='70'>";
                }
                echo "</td>
            <td>{$fila['descripcion']}</td>
            <td><img src='{$fila['imagen']}' alt='{$fila['nombre']}' width='60'></td>";

                // Agregar botones si está logueado
                if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
                    echo "
           
            <td><a href='modificar.php?id={$fila['numero']}'><button>Modificar</button></a></td>
            <td><a href='eliminar.php?id={$fila['numero']}' onclick=\"return confirm('¿Estás seguro de eliminar este Pokémon?');\"><button>Eliminar</button></a></td>";
                }

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron Pokémon.";
        }
        ?>
        </tbody>

        <!-- MODAL PARA AGREGAR POKÉMON -->
        <div id="modalAgregar" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4" style="max-width:600px">
                <header class="w3-container w3-teal">
      <span onclick="document.getElementById('modalAgregar').style.display='none'"
            class="w3-button w3-display-topright">&times;</span>
                    <h2>Agregar Pokémon</h2>
                </header>
                <div class="w3-container">
                    <form action="agregar.php" method="POST" enctype="multipart/form-data" class="w3-container w3-padding">
                        <label class="w3-text-teal"><b>Número</b></label>
                        <input class="w3-input w3-border" type="number" name="numero" required>

                        <label class="w3-text-teal"><b>Nombre</b></label>
                        <input class="w3-input w3-border" type="text" name="nombre" required>

                        <label class="w3-text-teal"><b>Tipo 1</b></label>
                        <select class="w3-select w3-border" name="tipo1" required>
                            <option value="" disabled selected>Elige un tipo</option>
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

                        <label class="w3-text-teal"><b>Tipo 2 (opcional)</b></label>
                        <select class="w3-select w3-border" name="tipo2">
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


                        <label class="w3-text-teal"><b>Descripción</b></label>
                        <textarea class="w3-input w3-border" name="descripcion" required></textarea>

                        <label class="w3-text-teal"><b>Imagen</b></label>
                        <input class="w3-input w3-border" type="file" name="imagen" accept="image/*" required>

                        <br>
                        <button class="w3-button w3-teal" type="submit">Guardar</button>
                        <button class="w3-button w3-grey" type="button" onclick="document.getElementById('modalAgregar').style.display='none'">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>

</div>

</body>
</html>

<?php
// Cerrar la conexión con la base de datos
$conexion->close();
?>
