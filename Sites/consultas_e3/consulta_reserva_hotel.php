<?php
session_start();
 
if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
          include('../templates/header_sin_searchbox_login.html');
}else{
    include('../templates/header_sin_searchbox.html');
    $mensaje = "Para comprar el ticket debes iniciar sesion";
}?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<body>

    <?php
      require("../config/conexion.php");
      $fecha_actual = date("Y-m-d", time());
      if (isset($_POST["hid"])){
        $seleccionado = $_POST["hid"];
        $nombre_hotel = $_POST["nombre"];
      }else{
        $seleccionado = $_SESSION["reserva"];
        $nombre_hotel = $_SESSION["reserva_nombre"];
      }
      
      $seleccionado = number_format($seleccionado);
      #Se construye la consulta como un string
      $query = "SELECT * FROM Hoteles WHERE Hoteles.hid = '$seleccionado'";
     
   

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_19 -> prepare($query);
	    $result -> execute();
      $resultados = $result -> fetchAll();
      
      $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=large&q=";
      $q = "{$nombre_hotel}";
      $q = str_replace(" ", "+", $q);
      $url = $base . $q;

      $response = file_get_contents($url);
      $manage = json_decode($response, true);
      print_r ($image);
      $image = $manage["items"][1]["link"];

      ?>

  <img src= <?php echo $image ?> id="bg" alt="">
      

    <div class= 'container mt-10'>
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Información del hotel  <?php echo $nombre_hotel; ?></h2>
      <div class="card-deck mb-3">
        <div class="card">
            <?php 
            if (isset($mensaje)){
                echo "<h7 class='text-center rounded-bottom bg-info text-white mb-8'>$mensaje</h7>";
            }
            if (! isset($_POST["hid"])){
                echo "<h7 class='text-center rounded-bottom bg-info text-white mb-8'>Las fecha de salida tiene que ir 
                antes de la de entrada.</h7>";
            }?>
          </div>
      </div>

      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre</th>
                <th class="text-white bg-danger" scope="col">Direccion</th>
                <th class="text-white bg-danger" scope="col">Telefono</th>
                <th class="text-white bg-danger" scope="col">Precio</th>
                <th class="text-white bg-danger" scope="col">Fecha de entrada</th>
                <th class="text-white bg-danger" scope="col">Fecha de salida</th>
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
                  $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
                  $_SESSION['user'] != "error contraseña"){
                    echo "<th class='text-white bg-danger' scope='col'>Comprar</th>";
                }?>


              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($resultados as $h) {
                  if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
                  $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
                  $_SESSION['user'] != "error contraseña"){
                      echo "<tr class='bg-dark'>
                              <td>$h[2]</td><td>$h[3]</td><td>$h[4]</td><td>$h[5]</td>
                              <td>
                              <form action='reservar_hotel.php' method='post' >
                                  <input type='date' id='start' name='start'
                                  value='$fecha_actual'
                                  min='$fecha_actual' max='2025-12-31'>
                              </td>
                              <td>
                                  <input type='date' id='finish' name='finish'
                                  value='$fecha_actual'
                                  min='$fecha_actual' max='2025-12-31'>
                              </td>
                              <td>
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $h[2] >
                                  <input type = 'hidden' name = 'hid' id = hid value = $h[1] >
                                  <input class='btn btn-primary' type='submit' value='RESERVAR'>
                              </form>
                              </td>
                            </tr>"; #Aca deberia poder poner un boton que deje reservar el hotel.
                  }else{
                      echo "<tr class='bg-dark'>
                              <td>$h[2]</td><td>$h[3]</td><td>$h[4]</td><td>$h[5]</td>
                              <td>
                              <form action='reservar_hotel.php' method='post' >
                                  <input type='date' id='start' name='start'
                                  value='$fecha_actual'
                                  min='$fecha_actual' max='2025-12-31'>
                              </td>
                              <td>
                                  <input type='date' id='finish' name='finish'
                                  value='$fecha_actual'
                                  min='$fecha_actual' max='2025-12-31'>
                              </form>
                              </td>
                            </tr>";
                  }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <form action="lista_hoteles.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Volver al listado de hoteles">
    </form>
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principal">
    </form>
  </div>
  <?php include('../templates/footer.html');?>

</html>