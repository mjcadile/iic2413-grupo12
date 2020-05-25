<?php
session_start();
?>
<?php include('../templates/header.html');   ?>

<body>

<h1 align="center"> Iniciar Sesion </h1>

  <br>

  <form align="center" action="iniciar_sesion.php" method="post">
    Username:
    
    <input type="text" name="username">
    <br/><br/>

    Contraseña:
    <input type="password" name="contrasena">
    <br/><br/>
    <?php if (! empty($_SESSION['user'])){
        if ($_SESSION['user'] == 'Contraseña erronea'){
            echo "Contraseña erronea";
        }elseif ($_SESSION['user'] == 'Usuario no encontrado'){
            echo "Usuario no registrado";
        }
    }?>

  <input type="submit" value="Iniciar sesion">
  </form>
 
  <br>
  <br>
  <br>

</body>
</html>
<?php include('../templates/footer.html'); ?>