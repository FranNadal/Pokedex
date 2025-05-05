<?php


session_start();              // Inicia la sesion actual
session_unset();              // Limpia todas las variables de sesion
session_destroy();            // Destruye la sesion
header("Location: index.php"); // Redirige al index
exit();                      // Finaliza el script
