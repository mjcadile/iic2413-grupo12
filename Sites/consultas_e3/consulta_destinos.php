<?php
session_start();
?>
<?php include('../templates/header.html');   ?>

<body>

    <?php
      require("../config/conexion.php");
    
      $origen = $_POST["origen"];
      $oid = $_POST["oid"];
      $oid = number_format($oid);
      $query = "SELECT destino, nombre_ciudad  FROM Destinos, Ciudades WHERE destino = cid 
      AND origen = $oid GROUP BY destino, nombre_ciudad;";
  
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_19 -> prepare($query);
	    $result -> execute();
      $resultados = $result -> fetchAll();
      
      $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=large&q=";
      $q = "{$origen}";
      $q = str_replace(" ", "+", $q);
      $url = $base . $q;

      $response = file_get_contents($url);
      $manage = json_decode($response, true);
      print_r ($image);
      $image = $manage["items"][1]["link"];

      ?>
  <img src= <?php echo $image ?> id="bg" alt="">
      

    <div class= 'container mt-10'>
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Elige tu destino. </h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Destinos</th>
                <th color = 'red' class="text-white bg-warning" scope="col">Consultar</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($resultados as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[1]</td>
                          <td>
                          <form action='consulta_compra_ticket.php' method='post' >
                              <input type = 'hidden' name = 'destino' id = 'destino' value = $n[1] >
                              <input type = 'hidden' name = 'dcid' id = dcid value = $n[0] >
                              <input type = 'hidden' name = 'oid' id = oid value = $oid >
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


    <form action="lista_origenes.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Volver al listado de origenes">
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