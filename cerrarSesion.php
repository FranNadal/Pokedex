<?php


session_start();              // Inicia la sesión actual
session_unset();              // Limpia todas las variables de sesión
session_destroy();            // Destruye la sesión
header("Location: index.php"); // Redirige al index
exit();                      // Finaliza el script
