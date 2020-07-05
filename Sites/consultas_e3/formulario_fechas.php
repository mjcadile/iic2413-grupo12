<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
    include('templates/header_login.html');
}else{
    include('templates/header.html');
}?>


<?php
    require("../config/conexion.php");
    $fecha_actual = date("Y-m-d", time());
    # Aca saco el uid
    $username = $_SESSION['user'];
    $query_uid = "SELECT uid FROM Usuarios WHERE Usuarios.username = '$username';";
    $resultado = $db_19 -> prepare($query_uid);
    $resultado -> execute();
    $uid_usuario = $resultado -> fetchAll();
    foreach ($uid_usuario as $u){
        $uid = number_format(intval($u[0]));
    }
    
?>
<img src="https://cdn.pixabay.com/photo/2014/11/02/10/41/aircraft-513641_1280.jpg" id="bg" alt="">

    <div class= 'container mt-10'>
        <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Consultar mis mensajes enviados <?php echo $nombre_hotel; ?></h2>
        <div class="card">
            <?php 
            if (isset($mensaje)){
                echo "<h7 class='text-center rounded-bottom bg-info text-white mb-8'>$mensaje</h7>";
            }
            if (! isset($_POST["hid"])){
                echo "<h7 class='text-center rounded-bottom bg-info text-white mb-8'>Las fecha de salida tiene que ir 
                antes de la de entrada.</h7>";
                echo "<tr class='bg-dark'>
                <td>
                <form action='ubicaciones_mensajes.php' method='post' >
                    <input type='date' id='start' name='start'
                    value='$fecha_actual'>
                </td>
                <td>
                    <input type='date' id='finish' name='finish'
                    value='$fecha_actual'>
                </td>
                <td>
                    <input type = 'hidden' name = 'uid' id = 'uid' value = $uid >
                    <input class='btn btn-primary' type='submit' value='CONSULTAR'>
                </form>
                </td>
              </tr>"
            }?>

        </div> 
    </div>

<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

