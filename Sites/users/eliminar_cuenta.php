<?php
session_start();

require("../config/conexion.php");

$username_actual = $_SESSION["user"];

$query = "UPDATE Usuarios SET username = '', nombre_usuario = '', correo = '', direccion_usuario = '', contrasena = '' 
        WHERE username = '$username_actual';";

$result = $db_19 -> prepare($query);
$result -> execute();
$resultado = $result -> fetchAll();

unset($_SESSION["user"]);
header("Location:../index.php");
?>