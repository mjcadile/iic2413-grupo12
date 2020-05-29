<?php
session_start();
include('../templates/header_sin_nada.html');
require("../config/conexion.php");  
$username = $_SESSION["user"];
$query_usuario = "SELECT nombre_usuario FROM Usuarios WHERE username = '$username';";
$result_user = $db_19 -> prepare($query_usuario);
$result_user -> execute();
$usuario = $result_user -> fetchAll(); 
foreach ($usuario as $us) {
    $nombre = $us[0];
}
?>

</head>

<style>

    hr.new1 {
      border-top: 2px solid white;
    }
</style>
    
    <!--Título y Navbar-->
    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5b/Michelangelo_-_Creation_of_Adam_%28cropped%29.jpg" id="bg" alt="">
        <div class="card border-info mb-4">
            <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/5/5b/Michelangelo_-_Creation_of_Adam_%28cropped%29.jpg" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">Splinter S.A</h2>
                <p class="card-text">Proyecto realizado por José Baboun, Sebastián Burgos, Matías Cadile y Richard Morales, IIC2413.</p>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <!--ul class="navbar-nav">
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </ul-->
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link disabled" href=""><?php echo "$nombre"; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Cerrar sesion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eliminar_cuenta.php">Eliminar mi cuenta</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <br>
</head>


<body>
    <img src="https://www.lavanguardia.com/r/GODO/LV/p5/WebSite/2018/06/15/Recortada/img_lbernaus_20180615-100456_imagenes_lv_terceros_istock-492416114-109-kn3E-U45119239404E0-992x558@LaVanguardia-Web.jpg" id="bg" alt="">
    <?php
        #Aca agregar 1° consulta sobre los museos
        $query_museos = "SELECT Entradas.lid, Entradas.fecha_compra FROM Usuarios, Entradas 
        WHERE Usuarios.uid = Entradas.uid AND Usuarios.username = '$username';";
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
      $tickets = $result_tickets -> fetchAll();?>
      

      <section id='tabs' class='project-tab'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-12'>
                        <nav>
                            <div class='nav nav-tabs nav-fill' id='nav-tab' role='tablist'>
                                <a class='nav-item nav-link active' id='nav-museos-tab' data-toggle='tab' href='#nav-museos' role='tab' aria-controls='nav-museos' aria-selected='true'>Mis entradas a museos</a>
                                <a class='nav-item nav-link' id='nav-hoteles-tab' data-toggle='tab' href='#nav-hoteles' role='tab' aria-controls='nav-hoteles' aria-selected='false'>Mis reservas de hoteles</a>
                                <a class='nav-item nav-link' id='nav-tickets-tab' data-toggle='tab' href='#nav-tickets' role='tab' aria-controls='nav-tickets' aria-selected='false'>Mis tickets de viaje</a>
                            </div>
                        </nav>
                        <div class='tab-content' id='nav-tabContent'>
                            <div class='tab-pane fade show active' id='nav-museos' role='tabpanel' aria-labelledby='nav-museos-tab'>
                              <div class='scrollable'>
                                <div class='table-responsive'>
                                  <table class='table table-bordered table-hover table-striped text-center table-dark'>
                                    <thead>
                                      <tr>
                                        <th class="text-white bg-danger" scope="col">Museo</th>
                                        <th class="text-white bg-danger" scope="col">Fecha de compra</th>
                                        <th class="text-white bg-danger" scope="col">Horario de apertura</th>
                                        <th class="text-white bg-danger" scope="col">Horario de cierre</th>
                                      </tr>
                                    </thead>
                                  <tbody>
                                  <?php
                                    foreach ($entradas_museos as $e) {
                                      $query_lugar = "SELECT Lugares.nombre, Museos.horario_apertura, Museos.horario_cierre 
                                          FROM Lugares, Museos WHERE Lugares.lid = Museos.lid AND Museos.lid = '$e[0]';";
                                      $result_lugar = $db_12 -> prepare($query_lugar);
                                      $result_lugar -> execute();
                                      $lugares = $result_lugar -> fetchAll();
                                      foreach ($lugares as $l){
                                        echo "<tr class='bg-dark'>
                                        <td>$l[0]</td>
                                        <td>$e[1]</td>
                                        <td>$l[1]</td>
                                        <td>$l[2]</td>
                                        </tr>";
                                      }
                                    }
                                  ?>
                                    </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                                  
                            <div class='tab-pane fade' id='nav-hoteles' role='tabpanel' aria-labelledby='nav-hoteles-tab'>
                              <div class='scrollable'>
                                <div class='table-responsive'>
                                  <table class='table table-bordered table-hover table-striped text-center table-dark'>
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
                                    }?>
                                  
                                    </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                             
                            <div class='tab-pane fade' id='nav-tickets' role='tabpanel' aria-labelledby='nav-tickets-tab'>
                              <div class='scrollable'>
                                <div class='table-responsive'>
                                  <table class='table table-bordered table-hover table-striped text-center table-dark'>
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
                                    }?>

                                    </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>"
  
  <form action="../index.php" method="get">
    <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principal">
  </form>
  
  <?php include('../templates/footer.html');?>
</body>

</html>