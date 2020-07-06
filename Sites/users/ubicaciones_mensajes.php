<?php
session_start();
$fecha_inicio = $_POST["start"];
$fecha_fin = $_POST["finish"];
if (strtotime($fecha_inicio) >= strtotime($fecha_fin)){
    header('Status: 301 Moved Permanently', false, 301);
    header('Location: formulario_fechas.php');
    header("Connection: close");
}else{
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
    ?>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>

    <img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">
    <br>

    <div id="mapid" style="height: 500px;"></div>
    <br>

    <?php 
    $contador = 0;
    $response = file_get_contents('https://lovely-glacier-09476.herokuapp.com/users/'.$uid);
    $response = json_decode($response, true);
    $mensajes = array_slice($response, 1);  
    ?>

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>

    <script> 
        var map = L.map('mapid').setView([51.505, -0.09], 7); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);


        <?php
            foreach($mensajes as $array) {
                $atributos = array();
                foreach ($array as $item) {
                array_push($atributos, $item);
                }
                $fecha = $atributos[0];
                if (strtotime($fecha) >= strtotime($fecha_inicio) && strtotime($fecha) <= strtotime($fecha_fin)){
                    $contador += 1;
                    $lat = $atributos[1];
                    $long = $atributos[2];
                    echo 'L.marker([' . $lat . ',' . $long . ']).addTo(map);';
            }  
        }?>
    </script>
    <?php
        if ($contador == 0) {
            echo "<div class='jumbotron'>
                <p class='lead'>Lo sentimos, al parecer aún no le envías mensajes a nadie entre esas fechas.</p>
            </div>
            <br>";
    }?>
    </html>
    <?php 
}
?>