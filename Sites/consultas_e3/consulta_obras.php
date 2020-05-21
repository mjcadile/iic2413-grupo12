<?php include('../templates/header.html');   ?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      $seleccionado = $_POST["oid"];
      $nombre_obra = $_POST["nombre"];
      $seleccionado = number_format($seleccionado);

      #Se construye la consulta como un string
 	    $artista_lugar = "SELECT Artistas.nombre, Lugares.nombre, Ciudades.nombre, Paises.nombre, Lugares.lid FROM Artistas, Lugares, Ciudades, Paises, Obras, Hecha_por
        WHERE Obras.oid = '$seleccionado' AND Obras.lid = Lugares.lid 
        AND Lugares.cid = Ciudades.cid AND Ciudades.pid = Paises.pid 
        AND Obras.oid = Hecha_por.oid AND Hecha_por.aid = Artistas.aid";

      $obra = "SELECT Obras.oid, Obras.nombre, Obras.ano_inicio, Obras.ano_termino, Obras.periodo FROM Obras WHERE Obras.oid = '$seleccionado'";

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
      $result = $db -> prepare($artista_lugar);
	    $result -> execute();
      $resultados_artista = $result -> fetchAll();
      
      $result = $db -> prepare($obra);
	    $result -> execute();
      $resultados_obra = $result -> fetchAll();
      
      $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=large&q=";
      $q = "{$nombre_obra}";
      $q = str_replace(" ", "+", $q);
      $url = $base . $q;

      $response = file_get_contents($url);
      $manage = json_decode($response, true);
      print_r ($image);
      $image = $manage["items"][1]["link"];

      ?>
  <img src= <?php echo $image ?> id="bg" alt="">


    <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Información de la obra</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col" >ID </th>
                <th class="text-white bg-danger" scope="col">Nombre</th>
                <th class="text-white bg-danger" scope="col">Ano Inicio</th>
                <th class="text-white bg-danger" scope="col">Ano de término</th>
                <th class="text-white bg-danger" scope="col">Periodo</th>


              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($resultados_obra as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td><td>$n[3]</td><td>$n[4]</td> 
                        </tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    



  <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Información del artista y lugar</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col" >Artista </th>
                <th class="text-white bg-danger" scope="col">Lugar</th>
                <th class="text-white bg-danger" scope="col">Ciudad</th>
                <th class="text-white bg-danger" scope="col">País</th>
                <th class="text-white bg-danger" scope="col">Más Información</th>


              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($resultados_artista as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td><td>$n[3]</td><td>
                            <form action='consulta_lugares.php' method='post' >
                              <input type = 'hidden' name = 'lid' id = 'lid' value = $n[4] >
                              <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                              <input class='btn btn-primary' type='submit' value='Sobre este lugar'>
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
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../js/actions.js"></script>
  <script src="js/actions.js"></script>
  
</body>

</html>