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
  foreach($response as $array) {
    foreach ($array as $item) {
      echo "<p>$item</p>";
    }
  }
?>