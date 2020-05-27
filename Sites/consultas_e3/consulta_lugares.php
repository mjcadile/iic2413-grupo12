<?php include('../templates/header_sin_searchbox.html');   ?>


<body>

  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
    <?php
      session_start();
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      $nombre_lugar = $_POST["nombre"];

      $seleccionado = $_POST["lid"];
      $seleccionado = number_format($seleccionado);

      #Se construye la consulta como un string
       $iglesia =  "SELECT Iglesias.lid, Iglesias.horario_apertura, Iglesias.horario_cierre FROM Lugares, Iglesias
        WHERE Iglesias.lid = '$seleccionado'";

       $museo = "SELECT Museos.lid, Museos.horario_apertura, 
       Museos.horario_cierre, Museos.precio FROM Lugares, Museos WHERE Museos.lid = '$seleccionado'";
       
       $plaza = "SELECT Plazas.lid, Lugares.nombre FROM Lugares, Plazas WHERE Plazas.lid = '$seleccionado'";

       $ubicacion = "SELECT Lugares.nombre, Ciudades.nombre, Paises.nombre 
       FROM Lugares, Ciudades, Paises WHERE Lugares.lid = '$seleccionado' 
       AND Lugares.cid = Ciudades.cid AND Ciudades.pid = Paises.pid";
       
       $obras = "SELECT DISTINCT Obras.oid, Obras.nombre, Obras.ano_inicio, Obras.ano_termino FROM Obras
       WHERE Obras.lid = '$seleccionado'";

       $artistas = "SELECT DISTINCT Artistas.aid, Artistas.nombre FROM Artistas INNER JOIN Hecha_por ON
       Artistas.aid = Hecha_por.aid INNER JOIN Obras ON Hecha_por.oid = Obras.oid
       INNER JOIN Lugares ON Obras.lid = Lugares.lid AND Lugares.lid = '$seleccionado'";


      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
      $result = $db_12 -> prepare($iglesia);
	    $result -> execute();
      $resultados_iglesia = $result -> fetchAll();
      
      $result = $db_12 -> prepare($museo);
	    $result -> execute();
      $resultados_museo = $result -> fetchAll();

      $result = $db_12 -> prepare($plaza);
	    $result -> execute();
      $resultados_plaza = $result -> fetchAll();

      $result = $db_12 -> prepare($ubicacion);
	    $result -> execute();
      $resultados_ubicacion = $result -> fetchAll();

      $result = $db_12 -> prepare($obras);
	    $result -> execute();
      $resultados_obras = $result -> fetchAll();

      $result = $db_12 -> prepare($artistas);
	    $result -> execute();
      $resultados_artistas = $result -> fetchAll();
  


  #Aquí pondremos la imagen de fondo para el lugar

  $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=large&q=";
  $q = "{$nombre_lugar}";
  $url = $base . $q;

  $response = file_get_contents($url);
  $manage = json_decode($response, true);
  print_r ($image);
  $image = $manage["items"][0]["link"];

    ?>
   <img src= <?php echo $image ?> id="bg" alt="">

    <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Información del lugar </h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <?php
                if (count($resultados_iglesia) != 0) {
                  echo 
                  "<tr>
                   <th class='text-white bg-danger' scope='col'>Nombre</th>
                   <th class='text-white bg-danger' scope='col'>Ciudad</th>
                   <th class='text-white bg-danger' scope='col'>País</th>
                   <th class='text-white bg-danger' scope='col'>Horario Apertura</th>
                   <th class='text-white bg-danger' scope='col'>Horario Cierre</th>
                   </tr>";
                }
                elseif (count($resultados_museo) != 0){
                  if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
                  $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
                  $_SESSION['user'] != "error contraseña") {
                    echo
                      "<tr>
                      <th class='text-white bg-danger' scope='col'>Nombre</th>
                      <th class='text-white bg-danger' scope='col'>Ciudad</th>
                      <th class='text-white bg-danger' scope='col'>País</th>
                      <th class='text-white bg-danger' scope='col'>Horario Apertura</th>
                      <th class='text-white bg-danger' scope='col'>Horario Cierre</th>
                      <th class='text-white bg-danger' scope='col'>Precio</th>
                      <th class='text-white bg-danger' scope='col'>Tickets</th>
                      </tr>";
                  }
                  else {
                    echo
                      "<tr>
                      <th class='text-white bg-danger' scope='col'>Nombre</th>
                      <th class='text-white bg-danger' scope='col'>Ciudad</th>
                      <th class='text-white bg-danger' scope='col'>País</th>
                      <th class='text-white bg-danger' scope='col'>Horario Apertura</th>
                      <th class='text-white bg-danger' scope='col'>Horario Cierre</th>
                      <th class='text-white bg-danger' scope='col'>Precio</th>
                      </tr>";
                  }
                  
                 }
                 else {
                  echo
                  "<tr>
                   <th class='text-white bg-danger' scope='col'>Nombre</th>
                   <th class='text-white bg-danger' scope='col'>Ciudad</th>
                   <th class='text-white bg-danger' scope='col'>País</th>
                   </tr>";
                 }
              ?>
            </thead>
            <tbody>
              <tr class='bg-dark'>
              <?php
                if (count($resultados_iglesia) != 0){
                  $resultados_def_lugar = [];
                  foreach ($resultados_ubicacion as $u) {
                    array_push($resultados_def_lugar, $u[0], $u[1], $u[2]);
                  }
                  foreach ($resultados_iglesia as $n) {
                    array_push($resultados_def_lugar, $n[0], $n[1], $n[2]);
                  }
                  echo "
                        <td>$resultados_def_lugar[0]</td>
                        <td>$resultados_def_lugar[1]</td>
                        <td>$resultados_def_lugar[2]</td>
                        <td>$resultados_def_lugar[4]</td>
                        <td>$resultados_def_lugar[5]</td>";
                }
                elseif (count($resultados_museo) != 0) {
                  $resultados_def_lugar = [];
                  foreach ($resultados_ubicacion as $u) {
                    array_push($resultados_def_lugar, $u[0], $u[1], $u[2]);
                  }
                  foreach ($resultados_museo as $n) {
                    array_push($resultados_def_lugar, $n[0], $n[1], $n[2], $n[3]);
                  }
                  if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
                  $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
                  $_SESSION['user'] != "error contraseña") {
                    echo "<td>$resultados_def_lugar[0]</td>
                            <td>$resultados_def_lugar[1]</td>
                            <td>$resultados_def_lugar[2]</td>
                            <td>$resultados_def_lugar[4]</td>
                            <td>$resultados_def_lugar[5]</td>
                            <td>$resultados_def_lugar[6]</td>
                            <td>
                              <form action='controller_compra_museo.php' method='post'>
                                <input type = 'hidden' name = 'lid' id = lid value = $resultados_def_lugar[3]>
                                <input type='submit' class='btn btn-primary mt-8 mb-5' value='Comprar ticket'>
                              </form>
                            </td>";
                  }
                  else {
                    echo "<td>$resultados_def_lugar[0]</td>
                            <td>$resultados_def_lugar[1]</td>
                            <td>$resultados_def_lugar[2]</td>
                            <td>$resultados_def_lugar[4]</td>
                            <td>$resultados_def_lugar[5]</td>
                            <td>$resultados_def_lugar[6]</td>";
                  }
                      
                }
                elseif (count($resultados_plaza) != 0) {
                  $resultados_def_lugar = [];
                  foreach ($resultados_ubicacion as $u) {
                    array_push($resultados_def_lugar, $u[0], $u[1], $u[2]);
                  }
                  foreach ($resultados_plaza as $n) {
                    array_push($resultados_def_lugar, $n[0])
                  }
                  echo "<td>$resultados_def_lugar[0]</td>
                        <td>$resultados_def_lugar[1]</td>
                        <td>$resultados_def_lugar[2]</td>";
                }
              ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    

  <div class="container-fluid mt-10">
    <h2 class="text-center rounded-bottom bg-info text-white mb-8">Obras </h2>
    <div class="scrollable">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped text-center table-dark">
          <thead>
            <tr>
              <th class="text-white bg-danger" scope="col" >Nombre</th>
              <th class="text-white bg-danger" scope="col">Fecha Inicio</th>
              <th class="text-white bg-danger" scope="col">Fecha Término</th>
              <th class="text-white bg-danger" scope="col" >Más Información</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($resultados_obras as $n) {
                $nombre = str_replace(' ', '+', $n[1]);
                echo "<tr class='bg-dark'>
                        <td>$n[1]</td><td>$n[2]</td><td>$n[3]</td><td>
                          <form action='consulta_obras.php' method='post' >
                            <input type = 'hidden' name = 'nombre' id = 'nombre' value = $nombre >
                            <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                            <input class='btn btn-primary' type='submit' value='Sobre esta obra'>
                          </form>
                        </td>
                      </tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Artistas con obras en el lugar</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col" >Nombre</th>
                <th class="text-white bg-danger" scope="col" >Más Información</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($resultados_artistas as $n) {
                  $nombre = str_replace(' ', '+', $n[1]);
                  echo "<tr class='bg-dark'>
                          <td>$n[1]</td><td>
                            <form action='consulta_artistas.php' method='post' >
                              <input type = 'hidden' name = 'nombre' id = 'nombre' value = $nombre >
                              <input type = 'hidden' name = 'aid' id = 'aid' value = $n[0] >
                              <input class='btn btn-primary' type='submit' value='Sobre este artista'>
                            </form>
                          </td>
                        </tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <form action="lista_artistas.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Volver al listado de artistas">
    </form>
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principal">
    </form>
  </div>

  <?php include('../templates/footer.html');?>