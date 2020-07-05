<?php
session_start();
include('../templates/header_sin_searchbox_login.html');
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
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">
<br>
<?php 
  
  $response = file_get_contents('https://lovely-glacier-09476.herokuapp.com/users/'.$uid);
  $response = json_decode($response, true);
  if (count($response) == 1) {
    echo "<h1>$response</h1>";
  } else {
    $mensajes = array_slice($response, 1);
    foreach($mensajes as $array) {
      $atributos = array();
      foreach ($array as $item) {
        array_push($atributos, $item);
      }
      $fecha = $atributos[0];
      $lat = $atributos[1];
      $long = $atributos[2];
      $message = $atributos[3];
      $mid = $atributos[4];
      $receptant = $atributos[5];
      $sender = $atributos[6]; 
      echo "<div class='card text-center'>
              <div class='card-header'>
                Mensaje #$mid
              </div>
              <div class='card-body'>
                <h5 class='card-title'>$message</h5>
                <p class='card-text'>Ubicación: Lat: $lat  |  Long: $long</p>
                <p class='card-text'>ID remitente: $sender</p>
                <p class='card-text'>ID destinatario: $receptant</p>
              </div>
              <div class='card-footer text-muted'>
                Fecha de emisión: $atributos[0]
              </div>
            </div
            <br>
            <br>";
    }
  }
  ?>
  <?php include('../templates/footer.html');?>