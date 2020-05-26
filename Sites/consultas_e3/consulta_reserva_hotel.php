<?php
session_start();
?>
<?php include('../templates/header_sin_searchbox.html');   ?>

<body>

    <?php
      require("../config/conexion.php");
    
      $seleccionado = $_POST["hid"];
      $nombre_hotel = $_POST["nombre"];
      $seleccionado = number_format($seleccionado);
      #Se construye la consulta como un string
      $query = "SELECT * FROM Hoteles WHERE Hoteles.hid = '$seleccionado'";
     
   

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_19 -> prepare($query);
	    $result -> execute();
      $resultados = $result -> fetchAll();
      
      $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=large&q=";
      $q = "{$nombre_hotel}";
      $q = str_replace(" ", "+", $q);
      $url = $base . $q;

      $response = file_get_contents($url);
      $manage = json_decode($response, true);
      print_r ($image);
      $image = $manage["items"][1]["link"];

      ?>
  <img src= <?php echo $image ?> id="bg" alt="">
      

    <div class= 'container mt-10'>
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Información del hotel  <?php echo $nombre_hotel; ?></h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre</th>
                <th class="text-white bg-danger" scope="col">Direccion</th>
                <th class="text-white bg-danger" scope="col">Telefono</th>
                <th class="text-white bg-danger" scope="col">Precio</th>
                <th class="text-white bg-danger" scope="col">Fecha de entrada</th>
                <th class="text-white bg-danger" scope="col">Fecha de salida</th>
                <th class="text-white bg-danger" scope="col">Comprar</th>


              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($resultados as $h) {
                  echo "<tr class='bg-dark'>
                          <td>$h[2]</td><td>$h[3]</td><td>$h[4]</td><td>$h[5]</td>
                          <td>
                          <form action='reservar_hotel.php' method='post' >
                              <input type='date' id='start' name='start'
                              value='2020-05-24'
                              min='2018-01-01' max='2025-12-31'>
                          </td>
                          <td>
                              <input type='date' id='finish' name='finish'
                              value='2020-05-24'
                              min='2018-01-01' max='2025-12-31'>
                          </td>
                          <td>
                              <input type = 'hidden' name = 'nombre' id = 'nombre' value = $h[2] >
                              <input type = 'hidden' name = 'hid' id = hid value = $h[1] >
                              <input class='btn btn-primary' type='submit' value='RESERVAR'>
                          </form>
                          </td>
                        </tr>"; #Aca deberia poder poner un boton que deje reservar el hotel.
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <form action="lista_hoteles.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Volver al listado de hoteles">
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