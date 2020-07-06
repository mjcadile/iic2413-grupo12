<?php
session_start();
include('../templates/header_sin_searchbox_login_msj.html');
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
$query_usuarios = "SELECT Usuarios.uid, Usuarios.nombre_usuario FROM Usuarios;";
$result_users = $db_19 -> prepare($query_usuarios);
$result_users -> execute();
$usuarios = $result_users -> fetchAll(); 
  

$contador = 0;
$response = file_get_contents('https://lovely-glacier-09476.herokuapp.com/messages');
$response = json_decode($response, true);
$mensajes = array_slice($response, 1);
echo "<div class='card'>
      <br>
          <div class='card-body'>
            <h3 class='card-title'>Mensajes enviados</h3>
          </div>
          <br>
      </div>
      <br>";
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
  if ($uid == $receptant){
    $contador += 1;
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
          </div>
          <br>
          <br>";
  }
}
if ($contador == 0 || $contador == 1) {
  echo "<div class='jumbotron'>
          <h1 class='display-4'>No tienes mensajes recibidos!</h1>
          <p class='lead'>Lo sentimos, al parecer aún tienes mensajes recibidos.</p>
          <hr class='my-4'>
          <p>Haz click aquí para utilizar nuestro servicio de mensajería.</p>
          <p class='lead'>
            <a class='btn btn-primary btn-lg' href='#' role='button'>Enviar mensajes</a>
            <a class='btn btn-primary btn-lg' href='../index.php' role='button'>Home</a>
          </p>
        </div>
        <br>";
}
  ?>
<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>