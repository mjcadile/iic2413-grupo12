<?php include('../templates/header.html');   ?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="https://okdiario.com/img/2017/09/18/renacimiento-e1505728926887.jpg" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");
    
      $busqueda = $_POST["pais"];

      #Se construye la consulta como un string
 	    $query_obras = "SELECT DISTINCT Obras.nombre, Ciudades.nombre, Paises.nombre
        FROM Obras, Lugares, Ciudades, Paises WHERE  Obras.lid = Lugares.lid AND Lugares.cid = Ciudades.cid AND
         Ciudades.pid = Paises.pid AND LOWER(Obras.nombre) LIKE LOWER('%$busqueda%');";

      $query_artistas = "SELECT DISTINCT Artistas.nombre, Artistas.nacimiento, Artistas.descripcion
      FROM Artistas WHERE   LOWER(Artistas.nombre) LIKE LOWER('%$busqueda%');";

      $query_lugares = "SELECT DISTINCT Lugares.nombre, Ciudades.nombre, Paises.nombre
      FROM Lugares, Ciudades, Paises WHERE  Lugares.lid = Lugares.lid AND Lugares.cid = Ciudades.cid AND
      Ciudades.pid = Paises.pid AND LOWER(Lugares.nombre) LIKE LOWER('%$busqueda%');";
        
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db -> prepare($query_obras);
	    $result -> execute();
      $obras = $result -> fetchAll();
      
      $result = $db -> prepare($query_artistas);
	    $result -> execute();
      $artistas = $result -> fetchAll();
      
      $result = $db -> prepare($query_lugares);
	    $result -> execute();
	    $lugares = $result -> fetchAll();
    ?>
    <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Resultados de obras</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Obra</th>
                <th class="text-white bg-danger" scope="col">Ciudad</th>
                <th class="text-white bg-danger" scope="col">País</th>
                <th class="text-white bg-danger" scope="col">Consultar</th>

              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($obras as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td>
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


  <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Resultados de artistas</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre</th>
                <th class="text-white bg-danger" scope="col">Nacimiento</th>
                <th class="text-white bg-danger" scope="col">Descripción</th>
                <th class="text-white bg-danger" scope="col">Consultar</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($artistas as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td>
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


  <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Resultados de lugares</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">nombre</th>
                <th class="text-white bg-danger" scope="col">Ciudad</th>
                <th class="text-white bg-danger" scope="col">País</th>
                <th class="text-white bg-danger" scope="col">Consultar</th>

              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($obras as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td>
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
  <?php include('templates/footer.html');?>