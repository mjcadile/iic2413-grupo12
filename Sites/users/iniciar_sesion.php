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

  $contrasena = $_POST["contrasena"];
  $contrasena = quitar_tildes($contrasena);

  $query = "SELECT username, contrasena FROM Usuarios;";
  $result = $db_19 -> prepare($query);
  $result -> execute();
  $usernames = $result -> fetchAll();

  foreach ($usernames as $u) {
    if ($u[0] == $username){
      if ($u[1] == $contrasena){
        $_SESSION['user'] = $username;
      }else{
        $_SESSION['user'] = 'Contraseña erronea';
      }
    }
  } 

  if (! empty($_SESSION['user']) && $_SESSION['user'] == $username){ 
    header('Status: 301 Moved Permanently', false, 301);
    header('Location: ../index.php');
    header("Connection: close");
    exit();
  } elseif (!empty($_SESSION['user']) && $_SESSION['user'] == 'Contraseña erronea'){
    header('Status: 301 Moved Permanently', false, 301);
    header('Location: sign_in.php');
    exit();
  } else{
    $_SESSION['user'] = 'Usuario no encontrado';
    header('Status: 301 Moved Permanently', false, 301);
    header('Location: sign_in.php');
    exit();
  }
?>