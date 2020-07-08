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


$receptor = $_POST['r_id'];
$mensaje = $_POST['message'];
$fecha = date("Y-m-d");
$lat = -33.42;
$long = -70.62;
 
$prueba = array( 
    "date" => $fecha, 
    "lat" =>$lat,
    "long" => $long,
    "message" => $mensaje,
    "receptant" => (int)$receptor); 

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

<style>

.sansserif {
  font-family: "Century Gothic", CenturyGothic, Geneva, AppleGothic, sans-serif;
}

}
</style>
<h1 div class="sansserif" class='card' > Mensaje guardado enviado correctamente  </h1>  





<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>