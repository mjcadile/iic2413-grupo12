<?php
session_start();
?>
<?php
require("../config/conexion.php");

function quitar_tildes($string) {
  $con_tildes= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
  $sin_tildes= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
  $texto = str_replace($con_tildes, $sin_tildes ,$string);
return $texto;
}

$username = $_POST["username"];
$username = quitar_tildes($username);
$_SESSION['user'] = $username;

$nombre =  $_POST["nombre"];
$nombre = quitar_tildes($nombre);

$correo = $_POST["correo"];
$correo = quitar_tildes($correo);

$direccion =  $_POST["direccion"];
$direccion = quitar_tildes($direccion);

$contrasena_1 = $_POST["contrasena"];
$contrasena_1 = quitar_tildes($contrasena_1);

$contrasena_2 =  $_POST["contrasena_confirm"];
$contrasena_2 = quitar_tildes($contrasena_2);


$query = "SELECT username FROM Usuarios;";

$result = $db_19 -> prepare($query);
$result -> execute();
$usernames = $result -> fetchAll();


foreach ($usernames as $u){ 
  if ($u[0] == $username){
      $_SESSION['user'] = "error username";
  }
}
if (!empty($username) && !empty($nombre) && !empty($correo) && !empty($direccion) 
    && !empty($contrasena_1) && !empty($contrasena_2)){

    if ($contrasena_1 <> $contrasena_2){
        $_SESSION['user'] = "error contraseña";
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: sign_up.php');
        exit();
    }elseif ($_SESSION['user'] == "error username"){
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: sign_up.php');
        exit();
    }else{
        $query_uid = "SELECT MAX(uid) FROM Usuarios;";
        $resultado = $db_19 -> prepare($query_uid);
        $resultado -> execute();

        $uid = $resultado -> fetchAll();

        foreach ($uid as $u) {
          $uid_max = number_format(intval($u[0]) + 1);
        }


        $query = "INSERT INTO Usuarios Values('$uid_max', '$username', '$nombre',
        '$correo', '$direccion', '$contrasena_1');";

        $result = $db_19 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: ../index.php');
        header("Connection: close");
        exit();
  }
}else{
    header('Status: 301 Moved Permanently', false, 301);
    header('Location: sign_up.php');
}?>