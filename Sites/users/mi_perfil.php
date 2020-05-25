<?php
session_start();
?>

<?php include('../templates/header.html');   ?>


<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="https://www.lavanguardia.com/r/GODO/LV/p7/WebSite/2020/03/20/Recortada/img_mbigas_20200320-143919_imagenes_lv_terceros_cuadritus-kpjD-U4742685883827EF-992x558@LaVanguardia-Web.jpg" id="bg" alt="">
    <?php
      require("../config/conexion.php");
      $username = $_SESSION["user"];

      #Aca agregar 1° consulta sobre los museos
 	    $query_museos = "ACA ESCRIBIR CONSULTA;";
      $result_museos = $db_19 -> prepare($query_museos);
      $result_museos -> execute();
      $entradas_museos = $result_museos -> fetchAll();

      # Aca van las reservas de alojamiento
      $query_reservas = "SELECT fecha_ingreso, fecha_salida, direccion FROM Usuarios, Hoteles, Reservas 
            WHERE Hoteles.hid = Reservas.hid AND Usuarios.uid = Reservas.uid 
            AND Usuarios.username = '$username' ORDER BY fecha_ingreso;";
      $result_reservas = $db_19 -> prepare($query_reservas);
      $result_reservas -> execute();
      $reservas = $result_reservas -> fetchAll();

      # Aca van los tickets
      $query_tickets = "SELECT numero_asiento, fecha_compra, fecha_viaje, origen, nombre_ciudad 
            AS destino FROM (SELECT numero_asiento, fecha_compra, fecha_viaje, nombre_ciudad AS origen, destino 
            FROM Usuarios, Tickets, Destinos, Ciudades WHERE Tickets.uid = Usuarios.uid 
            AND Tickets.did = Destinos.did AND origen = cid AND Usuarios.username = '$username') 
            AS Origenes, Ciudades WHERE cid = destino ORDER BY fecha_viaje;";
      $result_tickets = $db_19 -> prepare($query_tickets);
      $result_tickets -> execute();
      $tickets = $result_tickets -> fetchAll();
    ?>
    <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Mis entradas a museos</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Museo</th>
                <th class="text-white bg-danger" scope="col">Fecha de compra</th>

              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach ($entradas_museos as $e) {
                  echo "<tr class='bg-dark'>
                          <td>$e[0]</td>
                          <td>$e[1]</td>
                        </tr>";
                }
  
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Mis reservas de alojamiento</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Fecha de ingreso</th>
                <th class="text-white bg-danger" scope="col">Fecha de salida</th>
                <th class="text-white bg-danger" scope="col">Dirección</th>

              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach ($reservas as $r) {
                  echo "<tr class='bg-dark'>
                          <td>$r[0]</td>
                          <td>$r[1]</td>
                          <td>$r[2]</td>
                        </tr>";
                }
  
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Mis tickets comprados</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Numero de asiento</th>
                <th class="text-white bg-danger" scope="col">Fecha de Compra</th>
                <th class="text-white bg-danger" scope="col">Fecha del viaje</th>
                <th class="text-white bg-danger" scope="col">Ciudad de origen</th>
                <th class="text-white bg-danger" scope="col">Ciudad de destino</th>

              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach ($tickets as $t) {
                  echo "<tr class='bg-dark'>
                          <td>$t[0]</td>
                          <td>$t[1]</td>
                          <td>$t[2]</td>
                          <td>$t[3]</td>
                          <td>$t[4]</td> 
                        </tr>";
                }
  
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú Principal">
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../js/actions.js"></script>
  <script src="js/actions.js"></script>


</body>

</html>