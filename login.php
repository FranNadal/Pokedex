<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokédex Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="./FrontEnd/estilos.css">
</head>

<body>

<div class="login-box w3-card-4">
    <div class="pokedex-header">
        <img src="./FrontEnd/img/logo_pokemon.png" alt="Pokeball">
        <h2><b>¡Hola, PokeAmigo!</b></h2>
    </div>

    <form class="w3-container" action="BackDelLogin.php" method="post">
        <label><b>Usuario</b></label>
        <input class="w3-input w3-margin-bottom w3-round" type="text" name="usuario" placeholder="Pokeusuario">

        <label><b>Contraseña</b></label>
        <input class="w3-input w3-margin-bottom w3-round" type="password" name="contrasena" placeholder="Pokecontraseña">

        <button class="w3-button w3-block w3-round pokedex-btn">Ingresar</button>
    </form>




</div>

?>
</body>
</html>
