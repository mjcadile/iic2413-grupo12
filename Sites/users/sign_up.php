<?php
session_start();
?>
<?php include('../templates/header.html');   ?>

<body>


<h1 align="center"> Registrate </h1>

    <br>

    <form align="center" action="registrarse.php" method="post">
      Nombre:
      <input type="text" name="nombre">
      <?php 
      if (!empty($_SESSION['user'])){
          if ($_SESSION['user'] == "error username"){
            echo "Username se encuentra ocupado, intente con otro.";
          }
      }?>
    <br/><br/>
    Username:
    <input type="text" name="username">
    <br/><br/>
    Correo:
    <input type="text" name="correo">
    <br/><br/>
    Dirección:
    <input type="text" name="direccion">
    <br/><br/>
    Contraseña:
    <input type="password" name="contrasena">
    <br/><br/>
    Repita contraseña:
    <input type="password" name="contrasena_confirm">
    <br/><br/>
    <?php if (! empty($_SESSION['user'])){
      if ($_SESSION['user'] == "error contraseña"){
        echo "Las contraseñas no coinciden, intente denuevo.";
      }
    }?>
    <input type="submit" value="Registrarse">
  </form>

  
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principal">
    </form>

</body>
</html>
<?php include('../templates/footer.html'); ?>