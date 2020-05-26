<?php
session_start();
?>
<?php
    require("../config/conexion.php");
    
    $fecha_actual = date("Y-m-d", time());

    $did = $_POST["did"];
    $did = number_format($did);

    $fecha_viaje = $_POST["fecha"];
    $fecha_viaje = date($fecha_viaje);
    
    # Aca saco el uid
    $username = $_SESSION['user'];
    $query_uid = "SELECT uid FROM Usuarios WHERE Usuarios.username = '$username';";
    $resultado = $db_19 -> prepare($query_uid);
    $resultado -> execute();
    $uid_usuario = $resultado -> fetchAll();
    foreach ($uid_usuario as $u){
        $uid = number_format(intval($u[0]));
    }
    # Numero de Ticket
    $query_max = "SELECT MAX(numero) FROM Tickets;";
    $resultado = $db_19 -> prepare($query_max);
    $resultado -> execute();
    $numero_max = $resultado -> fetchAll();
    foreach ($numero_max as $r){
        $numero = number_format(intval($r[0]) + 1);
    }
    # Capacidad maxima del viaje
    $query_cap = "SELECT capacidad_maxima FROM Destinos WHERE Destinos.did = '$did';";
    $resultado = $db_19 -> prepare($query_cap);
    $resultado -> execute();
    $capacidad_viaje = $resultado -> fetchAll();
    foreach ($capacidad_viaje as $r){
        $capacidad = intval($r[0]);
    }
    # Numero de asiento
    $query_as = "SELECT numero_asiento FROM Tickets WHERE did = '$did' AND fecha_viaje = '$fecha_viaje';";
    $resultado = $db_19 -> prepare($query_as);
    $resultado -> execute();
    $asientos = $resultado -> fetchAll();

    $verificador = FALSE;
    $i = 1;
    while ($i < $capacidad && $verificador == FALSE){
        if (in_array($i, $asientos)){
            $i++;
        }else{
            $verificador = TRUE;
            $asiento = $i;
        }
    }

    if (! array($asiento)){
        $query = "INSERT INTO Tickets VALUES('$numero', '$did', '$uid', '$asiento',
                '$fecha_actual', '$fecha_viaje');";
        $agregar = $db_19 -> prepare($query);
        $agregar -> execute();
        $resultado = $agregar -> fetchAll();
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: ../index.php');
        header("Connection: close");
        exit();
    }
?>