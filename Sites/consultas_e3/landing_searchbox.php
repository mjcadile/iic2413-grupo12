<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
          include('../templates/header_sin_searchbox_login.html');
}else{
    include('../templates/header_sin_searchbox.html');
}?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      #Se guarda lo que viene de index.php
      $busqueda = $_POST["search"];

       # $_POST["opcion_1"] --> artistas
       # $_POST["opcion_2"] --> obras
       # $_POST["opcion_3"] --> lugares
      
      #Se crean las consultas correspondientes
      $query_obras = "SELECT DISTINCT Obras.oid, Obras.nombre, Ciudades.nombre, Paises.nombre
      FROM Obras, Lugares, Ciudades, Paises WHERE  Obras.lid = Lugares.lid AND Lugares.cid = Ciudades.cid AND
       Ciudades.pid = Paises.pid AND LOWER(Obras.nombre) LIKE LOWER('%$busqueda%');";

      $query_artistas = "SELECT DISTINCT Artistas.aid, Artistas.nombre
      FROM Artistas WHERE LOWER(Artistas.nombre) LIKE LOWER('%$busqueda%');";

      $query_lugares = "SELECT DISTINCT Lugares.lid, Lugares.nombre, Ciudades.nombre, Paises.nombre
      FROM Lugares, Ciudades, Paises WHERE  Lugares.lid = Lugares.lid AND Lugares.cid = Ciudades.cid AND
      Ciudades.pid = Paises.pid AND LOWER(Lugares.nombre) LIKE LOWER('%$busqueda%');";

      $query_hoteles = "SELECT DISTINCT Hoteles.hid, Hoteles.nombre_hotel, Ciudades.nombre_ciudad, Paises.nombre_pais, Hoteles.precio_hotel 
      FROM Ciudades, Paises, Hoteles WHERE  Ciudades.cid = Hoteles.cid AND Ciudades.pid = Paises.pid 
      AND LOWER(Hoteles.nombre_hotel) LIKE LOWER('%$busqueda%');";
        
      $query_vuelos_origen = "SELECT DISTINCT ParisOrigin.origen, ParisOrigin.nombre_ciudad, Destiny.destino, Destiny.nombre_ciudad FROM
      (SELECT DISTINCT Destinos.origen, Ciudades.nombre_ciudad FROM Ciudades, Destinos WHERE LOWER(Ciudades.nombre_ciudad) LIKE LOWER('%$busqueda%') AND 
      Ciudades.cid = Destinos.origen) AS ParisOrigin, (SELECT DISTINCT Destinos.destino, Ciudades.nombre_ciudad FROM Destinos, Ciudades WHERE
      Ciudades.cid = Destinos.destino) AS Destiny, Destinos WHERE ParisOrigin.origen = Destinos.origen AND
      Destinos.destino = Destiny.destino;";

      $query_vuelos_destino = "SELECT DISTINCT Origin.origen, Origin.nombre_ciudad, ParisDestiny.nombre_ciudad, ParisDestiny.destino FROM
      (SELECT DISTINCT Destinos.origen, Ciudades.nombre_ciudad FROM Ciudades, Destinos WHERE Ciudades.cid = Destinos.origen) AS Origin, 
      (SELECT DISTINCT Destinos.destino, Ciudades.nombre_ciudad FROM Destinos, Ciudades WHERE
      Ciudades.cid = Destinos.destino AND LOWER(Ciudades.nombre_ciudad) LIKE LOWER('%paris%')) AS ParisDestiny, Destinos WHERE Origin.origen = Destinos.origen AND
      Destinos.destino = ParisDestiny.destino;";
      
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
      $result = $db_12 -> prepare($query_obras);
      $result -> execute();
      $obras = $result -> fetchAll();
      
      $result = $db_12 -> prepare($query_artistas);
      $result -> execute();
      $artistas = $result -> fetchAll();
      
      $result = $db_12 -> prepare($query_lugares);
      $result -> execute();
      $lugares = $result -> fetchAll();

      $result = $db_19 -> prepare($query_hoteles);
      $result -> execute();
      $hoteles = $result -> fetchAll();

      $result = $db_19 -> prepare($query_vuelos_origen);
      $result -> execute();
      $vuelos_origen = $result -> fetchAll();

      $result = $db_19 -> prepare($query_vuelos_destino);
      $result -> execute();
      $vuelos_destino = $result -> fetchAll();


      echo
      "<section id='tabs' class='project-tab'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-12'>
                        <nav>
                            <div class='nav nav-tabs nav-fill' id='nav-tab' role='tablist'>
                                <a class='nav-item nav-link active' id='nav-artistas-tab' data-toggle='tab' href='#nav-artistas' role='tab' aria-controls='nav-artistas' aria-selected='true'>Resultados Artistas</a>
                                <a class='nav-item nav-link' id='nav-obras-tab' data-toggle='tab' href='#nav-obras' role='tab' aria-controls='nav-obras' aria-selected='false'>Resultados Obras</a>
                                <a class='nav-item nav-link' id='nav-lugares-tab' data-toggle='tab' href='#nav-lugares' role='tab' aria-controls='nav-lugares' aria-selected='false'>Resultados Lugares</a>
                                <a class='nav-item nav-link' id='nav-vuelos-tab' data-toggle='tab' href='#nav-vuelos' role='tab' aria-controls='nav-vuelos' aria-selected='false'>Resultados Vuelos</a>
                                <a class='nav-item nav-link' id='nav-hoteles-tab' data-toggle='tab' href='#nav-hoteles' role='tab' aria-controls='nav-hoteles' aria-selected='false'>Resultados Hoteles</a>
                            </div>
                        </nav>
                        <div class='tab-content' id='nav-tabContent'>
                            <div class='tab-pane fade show active' id='nav-artistas' role='tabpanel' aria-labelledby='nav-artistas-tab'>
                              <div class='scrollable'>
                                <div class='table-responsive'>
                                  <table class='table table-bordered table-hover table-striped text-center table-dark'>
                                    <thead>
                                      <tr>
                                        <th class='text-white bg-danger' scope='col' >Nombre</th>
                                        <th color = 'red' class='text-white bg-warning' scope='col'>Consultar</th>
                                      </tr>
                                    </thead>
                                  <tbody>";
                                  foreach ($artistas as $n) {
                                    echo "<tr class='bg-dark'>
                                            <td>$n[1]</td>
                                            <td>
                                            <form action='consulta_artistas.php' method='post' >
                                                <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                                <input type = 'hidden' name = 'aid' id = 'aid' value = $n[0] >
                                                <input class='btn btn-primary' type='submit' value='Sobre este artista'>
                                            </form>
                                            </td>
                                          </tr>";
                                  }
                                  echo 
                                    "</tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>";
                          echo          
                            "<div class='tab-pane fade' id='nav-obras' role='tabpanel' aria-labelledby='nav-obras-tab'>
                              <div class='scrollable'>
                                <div class='table-responsive'>
                                  <table class='table table-bordered table-hover table-striped text-center table-dark'>
                                    <thead>
                                      <tr>
                                        <th class='text-white bg-danger' scope='col'>Obra</th>
                                        <th class='text-white bg-danger' scope='col'>Ciudad</th>
                                        <th class='text-white bg-danger' scope='col'>País</th>
                                        <th color = 'red' class='text-white bg-warning' scope='col'>Consultar</th>
                                      </tr>
                                    </thead>
                                  <tbody>";
                                  foreach ($obras as $n) {
                                    echo "<tr class='bg-dark'>
                                            <td>$n[1]</td>
                                            <td>$n[2]</td>
                                            <td>$n[3]</td>
                                            <td>
                                            <form action='consulta_obras.php' method='post' >
                                                <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                                <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                                                <input class='btn btn-primary' type='submit' value='Sobre esta obra'>
                                            </form>
                                            </td>
                                          </tr>";
                                  }
                                  echo 
                                    "</tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>";
                            
                          echo    
                            "<div class='tab-pane fade' id='nav-lugares' role='tabpanel' aria-labelledby='nav-lugares-tab'>
                              <div class='scrollable'>
                                <div class='table-responsive'>
                                  <table class='table table-bordered table-hover table-striped text-center table-dark'>
                                    <thead>
                                      <tr>
                                        <th class='text-white bg-danger' scope='col'>Lugar</th>
                                        <th class='text-white bg-danger' scope='col'>Ciudad</th>
                                        <th class='text-white bg-danger' scope='col'>País</th>
                                        <th color = 'red' class='text-white bg-warning' scope='col'>Consultar</th>
                                      </tr>
                                    </thead>
                                  <tbody>";
                                  foreach ($lugares as $n) {
                                    echo "<tr class='bg-dark'>
                                            <td>$n[1]</td>
                                            <td>$n[2]</td>
                                            <td>$n[3]</td>
                                            <td>
                                            <form action='consulta_lugares.php' method='post' >
                                                <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                                <input type = 'hidden' name = 'lid' id = 'lid' value = $n[0] >
                                                <input class='btn btn-primary' type='submit' value='Sobre este lugar'>
                                            </form>
                                            </td>
                                          </tr>";
                                  }
                                  echo 
                                    "</tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>";

                              echo    
                            "<div class='tab-pane fade' id='nav-hoteles' role='tabpanel' aria-labelledby='nav-hoteles-tab'>
                              <div class='scrollable'>
                                <div class='table-responsive'>
                                  <table class='table table-bordered table-hover table-striped text-center table-dark'>
                                    <thead>
                                      <tr>
                                        <th class='text-white bg-danger' scope='col'>Nombre</th>
                                        <th class='text-white bg-danger' scope='col'>Ciudad</th>
                                        <th class='text-white bg-danger' scope='col'>País</th>
                                        <th color = 'red' class='text-white bg-warning' scope='col'>Consultar</th>
                                      </tr>
                                    </thead>
                                  <tbody>";
                                  foreach ($hoteles as $n) {
                                    echo "<tr class='bg-dark'>
                                            <td>$n[1]</td>
                                            <td>$n[2]</td>
                                            <td>$n[3]</td>
                                            <td>
                                            <form action='consulta_reserva_hotel.php' method='post' >
                                                <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                                <input type = 'hidden' name = 'hid' id = 'hid' value = $n[0] >
                                                <input class='btn btn-primary' type='submit' value='Más sobre este hotel'>
                                            </form>
                                            </td>
                                          </tr>";
                                  }
                                  echo 
                                    "</tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>";


                              echo          
                              "<div class='tab-pane fade' id='nav-vuelos' role='tabpanel' aria-labelledby='nav-vuelos-tab'>
                                <div class='scrollable'>
                                  <div class='table-responsive'>
                                    <table class='table table-bordered table-hover table-striped text-center table-dark'>
                                      <thead>
                                        <tr>
                                          <th class='text-white bg-danger' scope='col'>Origen</th>
                                          <th class='text-white bg-danger' scope='col'>Destino</th>
                                          <th color = 'red' class='text-white bg-warning' scope='col'>Consultar</th>
                                        </tr>
                                      </thead>
                                    <tbody>";
                                    foreach ($vuelos_origen as $n) {
                                      echo "<tr class='bg-dark'>
                                              <td>$n[1]</td>
                                              <td>$n[3]</td>
                                            
                                              <td>
                                              <form action='consulta_compra_ticket.php' method='post' >
                                                  <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                                                  <input type = 'hidden' name = 'dcid' id = 'dcid' value = $n[2] >
                                                  <input type = 'hidden' name = 'destino' id = 'destino' value = $n[3] >
                                                  <input class='btn btn-primary' type='submit' value='Más sobre el vuelo'>
                                              </form>
                                              </td>
                                            </tr>";
                                    }
                                    foreach ($vuelos_destino as $n) {
                                      echo "<tr class='bg-dark'>
                                              <td>$n[1]</td>
                                              <td>$n[2]</td>
                                              
                                              <td>
                                              <form action='consulta_compra_ticket.php' method='post' >
                                                  <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                                                  <input type = 'hidden' name = 'dcid' id = 'dcid' value = $n[3] >
                                                  <input type = 'hidden' name = 'destino' id = 'destino' value = $n[2] >
                                                  <input class='btn btn-primary' type='submit' value='Más sobre el vuelo'>
                                              </form>
                                              </td>
                                            </tr>";
                                    }
                                    echo 
                                      "</tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>";
    ?>
  
  <form action="../index.php" method="get">
    <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principal">
  </form>
  
  <?php include('../templates/footer.html');?>