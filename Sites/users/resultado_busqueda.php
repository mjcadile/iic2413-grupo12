<?php
# inspiracion: https://stackoverflow.com/questions/59873127/how-to-pass-raw-body-parameters-in-post-api

session_start();
include('../templates/header_sin_searchbox_login_msj.html');
require("../config/conexion.php");

$data = $_POST['search'];

$desired = explode(".", $data[0]);
$required = explode(".", $data[1]);
$forbidden = explode(" ", $data[2]);
$userId = $data[3];

$consulta = array();

if ($desired != [""]){
  $consulta["desired"] = $desired;
}

if ($required != [""]){
  $consulta["required"] = $required;
}

if ($forbidden != [""]){
  $consulta["forbidden"] = $forbidden;
}

if (is_numeric($userId) == true){
  $consulta["userId"] = intval($userId);
}

$prueba = json_encode($consulta);

echo $prueba;


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://lovely-glacier-09476.herokuapp.com/text-search",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => $prueba,
  CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);


$response = json_decode($response, true);
$mensajes = array_slice($response, 1);

$aux = true;

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  foreach($mensajes as $array) {
    $aux = false;
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
          </div>
          <br>
          <br>";
  }
}


if ($aux == true){
  echo "<div class='jumbotron'>
          <h1 class='display-4'>¡No se obtuvieron mensajes!</h1>
          <p class='lead'>Lo sentimos, intenta otra búsqueda.</p>
          <hr class='my-4'>
          <p>Haz click aquí para utilizar nuestro servicio de búsqueda de mensajes.</p>
          <p class='lead'>
            <a class='btn btn-primary btn-lg' href='busqueda_msj.php' role='button'>Enviar mensajes</a>
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