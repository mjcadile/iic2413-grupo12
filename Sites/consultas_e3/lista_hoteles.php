<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
          include('../templates/header_sin_searchbox_login.html');;
}else{
    include('../templates/header_sin_searchbox.html');
}?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

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
  <?php include('../templates/footer.html');?>

</html>


