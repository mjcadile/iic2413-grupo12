<?php include('../templates/header.html');   ?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="https://www.aciprensa.com/imagespp/IglesiaAlemania_Unsplash_130619.jpg" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      $h_apertura = $_POST["h_apertura"];
      $h_cierre = $_POST["h_cierre"];
      $ciudad = $_POST["ciudad"];
      $searchVal = array("á", "é", "í", "ó", "ú", 'Á', "É", "Í", "Ó", "Ú");
      $replaceVal = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
      $ciudad = str_replace($searchVal, $replaceVal, $ciudad);
      $ciudad= strtolower($ciudad);

      #Se construye la consulta como un string
 	    $query = "SELECT Iglesias.nombre, Frescos.nombre FROM 
         (SELECT Lugares.lid, Lugares.nombre FROM Iglesias, Lugares,Ciudades 
         WHERE Iglesias.lid = Lugares.lid AND Lugares.cid = Ciudades.cid AND 
         Iglesias.horario_apertura <= '$h_apertura' AND Iglesias.horario_cierre >= '$h_cierre' 
         AND LOWER(Ciudades.nombre) LIKE LOWER('%$ciudad%')) AS Iglesias, (SELECT * FROM 
         Frescos, Obras WHERE Frescos.oid = Obras.oid) AS Frescos WHERE Frescos.lid = Iglesias.lid;";
   
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db -> prepare($query);
	    $result -> execute();
	    $tupla = $result -> fetchAll();
    ?>
    <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Iglesias abiertas entre <?php echo $h_apertura?> - <?php echo $h_cierre?> </h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre Iglesia</th>
                <th class="text-white bg-warning" scope="col">Nombre Fresco</th>
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
    <form action="../index_copia.php" method="get">
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