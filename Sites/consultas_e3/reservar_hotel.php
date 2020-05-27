<?php
    session_start();
?>
<?php
#AGREGAR CONDICION DE QUE SI UN USUARIO ESTA CONECTADO PUEDE HACER ESTO.
    require("../config/conexion.php");
    
    $hid = $_POST["hid"];
    $nombre_hotel = $_POST["nombre"];
    $hid = number_format($hid);
    $fecha_entrada = $_POST["start"];
    $fecha_salida = $_POST["finish"];
    if (strtotime($fecha_entrada) <= strtotime($fecha_salida)){
        $username = $_SESSION['user'];
        $query_uid = "SELECT uid FROM Usuarios WHERE Usuarios.username = '$username';";
        $result = $db_19 -> prepare($query_uid);
        $result -> execute();
        $uid_usuario = $result -> fetchAll();
        foreach ($uid_usuario as $u){
            $uid = number_format(intval($u[0]));
        }

        $query_max = "SELECT MAX(rid) FROM Reservas;";
        $resultado = $db_19 -> prepare($query_max);
        $resultado -> execute();
        $rid_max = $resultado -> fetchAll();
        foreach ($rid_max as $r){
            $rid = number_format(intval($r[0]) + 1);
        }

        $query = "INSERT INTO Reservas VALUES('$rid', '$hid', '$uid', '$fecha_entrada', '$fecha_salida');";
        $agregar = $db_19 -> prepare($query);
        $agregar -> execute();
        $resultado = $agregar -> fetchAll();
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: ../index.php');
        header("Connection: close");
        exit();
    }else{
        $_SESSION["reserva"] = $hid;
        $_SESSION["reserva_nombre"] = $nombre_hotel;
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: consulta_reserva_hotel.php');
        header("Connection: close");
        exit();
    }
?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

