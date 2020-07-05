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
      echo "
        <div class='row'>
          <p> Mensaje #$mid </p>
          <div class='col-4'>
            <div class='list-group' id='list-tab' role='tablist'>
              <a class='list-group-item list-group-item-action active' id='list-home-list' data-toggle='list' href='#list-home' role='tab' aria-controls='home'>Información</a>
              <a class='list-group-item list-group-item-action' id='list-profile-list' data-toggle='list' href='#list-profile' role='tab' aria-controls='profile'>Mensaje</a>
              <a class='list-group-item list-group-item-action' id='list-messages-list' data-toggle='list' href='#list-messages' role='tab' aria-controls='messages'>Ubicación</a>
            </div>
          </div>
          <div class='col-8'>
            <div class='tab-content' id='nav-tabContent'>
              <div class='tab-pane fade show active' id='list-home' role='tabpanel' aria-labelledby='list-home-list'>
              <p>Fecha de emisión: $fecha</p>
              <p>ID de emisor: $sender</p>
              <p>ID de destinatario: $receptant</p>
              </div>
              <div class='tab-pane fade' id='list-profile' role='tabpanel' aria-labelledby='list-profile-list'>$mensaje</div>
              <div class='tab-pane fade' id='list-messages' role='tabpanel' aria-labelledby='list-messages-list'>Longitud: $long  |  Latitud: $lat</div>
            </div>
          </div>
        </div
      ";
    }
  }
  ?>
  