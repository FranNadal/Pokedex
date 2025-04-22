<?php
// Recuperar el mensaje de error de la URL
$message = isset($_GET['message']) ? $_GET['message'] : 'unknown_error';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Algo salió mal!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="error-container">
        <h1>Algo salio mal</h1>
        <p>
            <?php
            if ($message == 'connection_error') {
                echo "Snorlax está bloqueando el camino... no pudimos conectarnos a la base de datos.";
            } else {
                echo "Snorlax sigue durmiendo... ocurrió un error desconocido. Intentá más tarde.";
            }
            ?>
        </p>
        <img src="recursos/img/error-icon.gif" alt="Error" class="error-icon">
        <br>
        <a href="index.php">Volver a la página principal</a>
    </div>
</body>
</html>
