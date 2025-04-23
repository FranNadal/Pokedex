<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokédex Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            background-color: #fff8dc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .login-box {
            width: 90%;
            max-width: 400px;
            margin: 5% auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 25px 5px rgba(255, 183, 0, 0.3);
        }
        .login-box h2 {
            text-align: center;
            color: #e74c3c;
        }
        .w3-input {
            background-color: #f5f5f5;
            color: #333;
            border: none;
        }
        .w3-input:focus {
            background-color: #eaeaea;
        }
        .w3-button.pokedex-btn {
            background-color: #e74c3c;
            color: white;
            margin-top: 20px;
        }
        .w3-button.pokedex-btn:hover {
            background-color: #c0392b;
        }
        .pokedex-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .pokedex-header img {
            width: 80px;
        }
        @media (max-width: 600px) {
            .login-box {
                margin: 10% auto;
                padding: 30px 20px;
            }
        }
    </style>
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

</body>
</html>
