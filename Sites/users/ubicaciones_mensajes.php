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
require("../config/conexion.php");
$fecha_inicio = $_POST["start"];
$fecha_fin = $_POST["finish"];
echo "$fecha_inicio";
echo "$fecha_fin";

?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">
<br>
<table>
    <tbody>
        <tr>
            <td style="text-align: center; border: none">
            <div id="mapid" style="height: 300px; width: 400px;"></div>
            </td>
        </tr>
    <tbody>
<table>


<br>

<?php 
  $contador = 0;
  $response = file_get_contents('https://lovely-glacier-09476.herokuapp.com/users/'.$uid);
  $response = json_decode($response, true);
  $mensajes = array_slice($response, 1);
  foreach($mensajes as $array) {
    $contador += 1;
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
    echo "$fecha, $lat, $long, $message, $mid, $receptant, $sender";
}?>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

<script> 
    var map = L.map('mapid').setView([51.505, -0.09], 13); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

    L.marker([51.5, -0.09]).addTo(map); 
</script>

</html>