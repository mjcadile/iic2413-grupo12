<?php
session_start();
include('../templates/header_sin_searchbox_login_msj.html');
require("../config/conexion.php");

$fecha = date("Y-m-d");
$lat = -33.42;
$long = -70.62;
 
$prueba = array( 
    "date" => $fecha, 
    "lat" =>$lat,
    "long" => $long,
    "message" => $mensaje,
    "mid"=> $n_messages + 1,
    "receptant" => $receptor,
    "sender" => $uid); 

$json = json_encode($prueba); 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://lovely-glacier-09476.herokuapp.com/messages",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $json,
  CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);


$response = json_decode($response, true);
$mensajes = array_slice($response, 1);
?>

<form action='resultado_busqueda.php' method='post'>
  <?php

  
    echo "<div class='card'>
            <br>
              <div class='card-body'>
                <h5 class='card-title'>Escriba el contenido del mensaje:</h5>
              </div>
              <div class='card-body'>
                <input name='search[]' type='text' placeholder='Escribe aquí'>
              </div>
            <br>
          </div>
          <br>";

    echo "<div class='card'>
          <br>
            <div class='card-body'>
              <h5 class='card-title'>Escriba el ID del destinatario:</h5>
            </div>
            <div class='card-body'>
              <input name='search[]' type='text' placeholder='Escribe aquí'>
            </div>
          <br>
        </div>
        <br>";




?>





<input type='submit' value='Enviar'>
</form>
<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>