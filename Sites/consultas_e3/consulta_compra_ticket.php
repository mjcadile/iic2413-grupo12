<?php
session_start();
 
if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
          include('../templates/header_sin_searchbox_login.html');;
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

      $oid = $_POST["oid"];
      $destino = $_POST["destino"];
      $dcid = $_POST["dcid"];
      $oid = number_format($oid);
      $dcid = number_format($dcid);

      

      $query = "SELECT did, Destinoss.origen, nombre_ciudad AS destino, hora, duracion, medio, precio_destino 
            FROM (SELECT did, nombre_ciudad AS origen, destino, hora, duracion, medio, precio_destino 
            FROM Ciudades, Destinos WHERE cid = origen AND cid = $oid) AS Destinoss, Ciudades 
            WHERE cid = destino AND cid = $dcid;";
      


      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_19 -> prepare($query);
	    $result -> execute();
      $resultados = $result -> fetchAll();
      
      $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=large&q=";
      $q = "{$destino}";
      $q = str_replace(" ", "+", $q);
      $url = $base . $q;

      $response = file_get_contents($url);
      $manage = json_decode($response, true);
      print_r ($image);
      $image = $manage["items"][1]["link"];

      ?>
  <img src= <?php echo $image ?> id="bg" alt="">
      

    <div class= 'container mt-10'>
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Elige la fecha de tu viaje. </h2>
          <div class="card">
            <?php 
            if (isset($mensaje)){
                echo "<h7 class='text-center rounded-bottom bg-info text-white mb-8'>$mensaje</h7>";
            }?>
          </div>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Origen</th>
                <th class="text-white bg-danger" scope="col">Destino</th>
                <th class="text-white bg-danger" scope="col">Hora</th>
                <th class="text-white bg-danger" scope="col">Duracion</th>
                <th class="text-white bg-danger" scope="col">Medio de transporte</th>
                <th class="text-white bg-danger" scope="col">Precio</th>
                <th class="text-white bg-danger" scope="col">Fecha de viaje</th>
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
                  $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
                  $_SESSION['user'] != "error contraseña"){
                    echo "<th class='text-white bg-danger' scope='col'>Compra de Ticket</th>";
                }?>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($resultados as $n) {
                  if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
                  $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
                  $_SESSION['user'] != "error contraseña"){
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td><td>$n[2]</td><td>$n[3]</td><td>$n[4]</td><td>$n[5]</td><td>$n[6]</td>
                              <td>
                              <form action='comprar_ticket.php' method='post' >
                                  <input type='date' id='fecha' name='fecha'
                                  value='$fecha_actual'
                                  min='$fecha_actual' max='2025-12-31'>
                                  </td>
                                  <td>
                                  <input type = 'hidden' name = 'did' id = did value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='COMPRAR'>
                              </form>
                              </td>
                            </tr>";
                  }else{
                    echo "<tr class='bg-dark'>
                              <td>$n[1]</td><td>$n[2]</td><td>$n[3]</td><td>$n[4]</td><td>$n[5]</td><td>$n[6]</td>
                              <td>
                              <form action='comprar_ticket.php' method='post' >
                                  <input type='date' id='fecha' name='fecha'
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


    <form action="lista_origenes.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Volver al listado de origenes">
    </form>
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principal">
    </form>
  </div>
  <?php include('../templates/footer.html');?>

</html>