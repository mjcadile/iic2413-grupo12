<?php include('../templates/header.html');   ?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="https://cdn3.m.admexico.mx/uploads/images/thumbs/mx/ad/1/s/2019/32/arte_5914_1200x630.jpg" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      $seleccionado = $_POST["lid"];
      $seleccionado = number_format($seleccionado);

      #Se construye la consulta como un string
       $iglesia =  "SELECT Lugares.nombre, 
       Iglesias.horario_apertura, Iglesias.horario_cierre FROM Lugares, Iglesias
        WHERE Iglesias.lid = '$seleccionado'";

       $museo = "SELECT Lugares.nombre, Museos.horario_apertura, 
       Museos.horario_cierre, Museos.precio FROM Lugares, Museos WHERE Museos.lid = '$seleccionado'";
       
       $plaza = "SELECT Lugares.nombre FROM Lugares, Plazas WHERE Plazas.lid = '$seleccionado'";

       $ubicacion = "SELECT Lugares.nombre, Ciudades.nombre, Paises.nombre 
       FROM Lugares, Ciudades, Paises WHERE Lugares.lid = '$seleccionado' 
       AND Lugares.cid = Ciudades.cid AND Ciudades.pid = Paises.pid";
       
       $obras = "SELECT DISTINCT Obras.oid, Obras.nombre, Obras.ano_inicio, Obras.ano_termino FROM Obras
       WHERE Obras.lid = '$seleccionado'";

       $artistas = "SELECT DISTINCT Artistas.aid, Artistas.nombre FROM Artistas INNER JOIN Hecha_por ON
       Artistas.aid = Hecha_por.aid INNER JOIN Obras ON Hecha_por.oid = Obras.oid
       INNER JOIN Lugares ON Obras.lid = Lugares.lid AND Lugares.lid = '$seleccionado'";


      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
      $result = $db -> prepare($iglesia);
	    $result -> execute();
      $resultados_iglesia = $result -> fetchAll();
      
      $result = $db -> prepare($museo);
	    $result -> execute();
      $resultados_museo = $result -> fetchAll();

      $result = $db -> prepare($plaza);
	    $result -> execute();
      $resultados_plaza = $result -> fetchAll();

      $result = $db -> prepare($ubicacion);
	    $result -> execute();
      $resultados_ubicacion = $result -> fetchAll();

      $result = $db -> prepare($obras);
	    $result -> execute();
      $resultados_obras = $result -> fetchAll();

      $result = $db -> prepare($artistas);
	    $result -> execute();
      $resultados_artistas = $result -> fetchAll();
  
    ?>
    <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Información del lugar</h2>
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
                    array_push($resultados_def_lugar, n[0], n[1], n[2]);
                  }
                  echo "<td>$resultados_def_lugar[0]</td>
                        <td>$resultados_def_lugar[1]</td>
                        <td>$resultados_def_lugar[2]</td>
                        <td>$resultados_def_lugar[3]</td>
                        <td>$resultados_def_lugar[4]</td>
                        <td>$resultados_def_lugar[5]</td>";
                }
                elseif (count($resultados_museo) != 0) {
                  $resultados_def_lugar = [];
                  foreach ($resultados_ubicacion as $u) {
                    array_push($resultados_def_lugar, $u[0], $u[1], $u[2]);
                  }
                  foreach ($resultados_museo as $n) {
                    array_push($resultados_def_lugar, n[0], n[1], n[2], n[3]);
                  }
                      echo "<td>$resultados_def_lugar[0]</td>
                            <td>$resultados_def_lugar[1]</td>
                            <td>$resultados_def_lugar[2]</td>
                            <td>$resultados_def_lugar[3]</td>
                            <td>$resultados_def_lugar[4]</td>
                            <td>$resultados_def_lugar[5]</td>
                            <td>$resultados_def_lugar[6]</td>
                            <td>
                              <form action='../index2.php' method='get'>
                                <input type='submit' class='btn btn-primary mt-8 mb-5' value='Comprar ticket'>
                              </form>
                            </td>";
                }
                elseif (count($resultados_plaza) != 0) {
                  $resultados_def_lugar = [];
                  foreach ($resultados_ubicacion as $u) {
                    array_push($resultados_def_lugar, $u[0], $u[1], $u[2]);
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
    <h2 class="text-center rounded-bottom bg-info text-white mb-8">Obras en este lugar</h2>
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
                echo "<tr class='bg-dark'>
                        <td>$n[1]</td><td>$n[2]</td><td>$n[3]</td><td>
                          <form action='consulta_obras.php' method='post' >
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
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Artistas con obras en este lugar</h2>
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
                  echo "<tr class='bg-dark'>
                          <td>$n[1]</td><td>
                            <form action='consulta_artistas.php' method='post' >
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
    <form action="../index2.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principal">
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../js/actions.js"></script>
  <script src="js/actions.js"></script>
  
</body>

</html>