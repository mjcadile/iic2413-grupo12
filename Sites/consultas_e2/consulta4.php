<?php include('../templates/header_sin_searchbox.html');   ?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="https://cdn3.m.admexico.mx/uploads/images/thumbs/mx/ad/1/s/2019/32/arte_5914_1200x630.jpg" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      #Se construye la consulta como un string
 	    $query = "SELECT Artistas.nombre, COUNT(Artistas.nombre) AS numero_obras FROM 
         Obras, Hecha_por, Artistas WHERE Obras.oid = Hecha_por.oid AND 
         Hecha_por.aid = Artistas.aid GROUP BY Artistas.nombre;";
   
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db -> prepare($query);
	    $result -> execute();
	    $tupla = $result -> fetchAll();
    ?>
    <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Artistas y su cantidad de participaciones</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre Artista</th>
                <th class="text-white bg-warning" scope="col">Cantidad Participaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($tupla as $t) {
                  echo "<tr class='bg-dark'>
                          <td>$t[0]</td><td>$t[1]</td>
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