<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Pokedex/includes/includeGeneral.php');

$bd = new database();

$conexion= $bd->getConexion();

$id_pokemon_a_eliminar = $_GET['id'];


$sql= "DELETE FROM pokemones WHERE numero = $id_pokemon_a_eliminar";

$conexion->query($sql);

// Redirigir luego de eliminar
header("Location: index.php?mensaje=eliminado");
exit();
