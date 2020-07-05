<?php
session_start();
include('../templates/header_sin_nada.html');
require("../config/conexion.php");  
$username = $_SESSION["user"];
$query_usuario = "SELECT Usuarios.uid, Usuarios.nombre_usuario FROM Usuarios WHERE username = '$username';";
$result_user = $db_19 -> prepare($query_usuario);
$result_user -> execute();
$usuario = $result_user -> fetchAll(); 
foreach ($usuario as $us) {
    $uid = $us[0];
    $nombre = $us[1];
}
?>
<!--?$query_uid = "SELECT uid FROM Usuarios WHERE Usuarios.username = '$username';";?-->

<?php 
  
  $response = file_get_contents('https://lovely-glacier-09476.herokuapp.com/users/1');
  $response = json_decode($response, true);
  if (count($response) == 1) {
    echo "<h1>$response</h1>";
  } else {
    $mensajes = array_slice($response, 1);
    foreach($mensajes as $array) {
      $fecha = $array[0];
      $lat = $array[1];
      $long = $array[2];
      $message = $array[3];
      $mid = $array[4];
      $receptant = $array[5];
      $sender = $array[6];
      echo "<div class='container-fluid>
            <h3>$fecha</h3>
            <h3>$lat</h3>
            <h3>$long</h3>
            <h3>$message</h3>
            <h3>$mid</h3>
            <h3>$receptant</h3>
            <h3>$sender</h3>
            </div>";
    }
  }
  ?>