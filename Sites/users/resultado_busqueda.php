<?php
# inspiracion: https://stackoverflow.com/questions/59873127/how-to-pass-raw-body-parameters-in-post-api

session_start();
include('../templates/header_sin_searchbox_login_msj.html');
require("../config/conexion.php");

$data = $_POST['search'];


$curl = curl_init();
$consulta = array("required" => ["nubes"]);

$prueba = json_encode($consulta);

echo "<div class='card text-center'>
        <div class='card-header'>
          $prueba
        </div>
      </div>";




curl_setopt_array($curl, array(
  CURLOPT_URL => "https://lovely-glacier-09476.herokuapp.com/text-search",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => $prueba,
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);



$r = new HttpRequest('https://lovely-glacier-09476.herokuapp.com/text-search', HttpRequest::METH_GET);
$r->setBody($prueba);
try {
    echo $r->send()->getBody();
} catch (HttpException $ex) {
    echo $ex;
}



$response = json_decode($response, true);
$mensajes = array_slice($response, 1);


if ($err) {
  echo "cURL Error #:" . $err;
} else {
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
          </div>
          <br>
          <br>";
  }
}


?>
<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>