<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login con W3.CSS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="w3-light-grey">

<div class="w3-container w3-center w3-padding-64">
    <div class="w3-card-4 w3-white w3-display-middle" style="width:300px; padding: 32px;">
        <h2 class="w3-text-teal">Iniciar Sesión</h2>

        <form class="w3-container" action="/" method="post">
            <label class="w3-text-grey"><b>Usuario</b></label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="usuario" required>

            <label class="w3-text-grey"><b>Contraseña</b></label>
            <input class="w3-input w3-border" type="password" name="contrasena" required>

            <button class="w3-button w3-teal w3-margin-top w3-block">Entrar</button>
        </form>


    </div>
</div>

</body>
</html>
