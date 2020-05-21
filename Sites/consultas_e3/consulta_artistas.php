<?php include('../templates/header.html');   ?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");
    
      $seleccionado = $_POST["aid"];
      $nombre_artista = $_POST["nombre"];
      $seleccionado = number_format($seleccionado);
      #Se construye la consulta como un string
      $query = "SELECT * FROM Artistas WHERE Artistas.aid = '$seleccionado'";
     
   
      $query_obras = "SELECT Obras.oid, Obras.nombre, Obras.ano_inicio, Obras.ano_termino, Obras.periodo
      FROM Artistas, Hecha_por, Obras WHERE Artistas.aid = Hecha_por.aid 
      AND Hecha_por.oid = Obras.oid AND Artistas.aid = '$seleccionado'";

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db -> prepare($query);
	    $result -> execute();
      $resultados = $result -> fetchAll();
      
      $result_o = $db -> prepare($query_obras);
	    $result_o -> execute();
      $obras = $result_o -> fetchAll();
      
      $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=xxlarge&q=";
      $q = "{$nombre_artista}";
      $url = $base . $q;

      $response = file_get_contents($url);
      $manage = json_decode($response, true);
      print_r ($image);
      $image = $manage["items"][0]["link"];

      ?>
  <img src= <?php echo $image ?> id="bg" alt="">
      

    <div class= 'container mt-10'>
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Información del artista  <?php echo $nombre_artista; ?></h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">ID</th>
                <th class="text-white bg-danger" scope="col">Nombre</th>
                <th class="text-white bg-danger" scope="col">Fecha de nacimiento</th>
                <th class="text-white bg-danger" scope="col">Descripción</th>

              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($resultados as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td><td>$n[3]</td>
                        </tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Obras del artista</h2>
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
                <th class="text-white bg-danger" scope="col">Consultar</th>



              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($obras as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td><td>$n[3]</td><td>$n[4]</td> <td>
                          <form action='consulta_obras.php' method='post' >
                              <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                              <input class='btn btn-primary' type='submit' value='CONSULTAR'>
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
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principalr">
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../js/actions.js"></script>
  <script src="js/actions.js"></script>
  
</body>

</html>