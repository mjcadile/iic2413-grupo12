<?php include('../templates/header.html');   ?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="https://okdiario.com/img/2017/09/18/renacimiento-e1505728926887.jpg" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");
    
      $seleccionado = $_POST["aid"];
      #Se construye la consulta como un string
      $query = "SELECT * FROM Artistas WHERE Artistas.aid = '%$seleccionado%'";
       
   
      $query_obras = "SELECT Obras.oid, Obras.nombre, Obras.ano_inicio, Obras.ano_termino, Obras.periodo
      FROM Artistas, Hecha_por, Obras WHERE Artistas.aid = Hecha_por.aid 
      AND Hecha_por.oid = Obras.oid AND Artistas.aid = '%$seleccionado%'";

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db -> prepare($query);
	    $result -> execute();
      $resultados = $result -> fetchAll();
      
      $result_o = $db -> prepare($query_obras);
	    $result_o -> execute();
	    $obras = $result_o -> fetchAll();
    ?>

    <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Museos de <?php echo $pais_original; ?> con obras del renacimiento</h2>
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
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Museos de <?php echo $pais_original; ?> con obras del renacimiento</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">ID  </th>
                <th class="text-white bg-danger" scope="col">Nombre</th>
                <th class="text-white bg-danger" scope="col">Ano Inicio</th>
                <th class="text-white bg-danger" scope="col">Ano de término</th>
                <th class="text-white bg-danger" scope="col">Periodo</th>


              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($obras as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td><td>$seleccionado</td>
                        </tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Volver">
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../js/actions.js"></script>
  <script src="js/actions.js"></script>
  
</body>

</html>