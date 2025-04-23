


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokédex Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="./FrontEnd/estilos.css">
    <link rel="stylesheet" href="./FrontEnd/home_page.css">

</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <img src="./FrontEnd/img/logo_pokemon.png" alt="Pokeball">
    <div class="username">

        <!-- si se inicio sesion se coloca el nombre del usuario, si no "Iniciar Sesion" -->
        <?php
        session_start();
        if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
            $nombre = $_SESSION['nombre'];
            echo "Hola, $nombre";
        } else {
            echo "Iniciar sesión";
        }
        ?>
    </div>
</div>

<!-- SEARCH BAR -->
<div class="search-container w3-container">
    <input class="w3-input w3-round w3-border" type="text" placeholder="Search Pokémon, ID...">
</div>

<!-- TABLE SPACE -->
<div class="table-container w3-container w3-card-4">
    <h3>Pokédex Data</h3>
    <table class="w3-table-all w3-hoverable">
        <thead>
        <tr class="w3-light-grey">
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Region</th>
        </tr>
        </thead>
        <tbody>
        <!-- Datos aquí -->
        <tr>
            <td>001</td>
            <td>Bulbasaur</td>
            <td>Grass/Poison</td>
            <td>Kanto</td>
        </tr>
        <!-- Puedes agregar más filas dinámicamente -->
        </tbody>
    </table>
</div>

</body>
</html>
