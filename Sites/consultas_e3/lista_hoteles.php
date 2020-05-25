<?php include('../templates/header.html');   ?>

<body>
  <img src="https://www.turismoenchile.cl/images/blog/15057073462.jpg" id="bg" alt="">
    <?php
      require("../config/conexion.php");

 	    $query = "SELECT hid, nombre_hotel, direccion FROM Hoteles;";
   
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_19 -> prepare($query);
	    $result -> execute();
	    $hoteles = $result -> fetchAll();
    ?>
    <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Todos los hoteles</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre Hotel</th>
                <th class="text-white bg-danger" scope="col">Direccion</th>
                <th color = 'red' class="text-white bg-warning" scope="col">Reservas</th>

              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach ($hoteles as $h) {
                  echo "<tr class='bg-dark'>
                          <td>$h[1]</td>
                          <td>$h[2]</td>
                          <td>
                          <form action='consulta_reserva_hotel.php' method='post' >
                              <input type = 'hidden' name = 'nombre' id = 'nombre' value = $h[1] >
                              <input type = 'hidden' name = 'hid' id = hid value = $h[0] >
                              <input class='btn btn-primary' type='submit' value='RESERVAR'>
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
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú Principal">
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../js/actions.js"></script>
  <script src="js/actions.js"></script>


</body>

</html>


