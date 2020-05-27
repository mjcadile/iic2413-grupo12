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
  <img src="https://cdn.pixabay.com/photo/2014/11/02/10/41/aircraft-513641_1280.jpg" id="bg" alt="">
    <?php
      require("../config/conexion.php");

      #Se construye la consulta como un string
 	    $query = "SELECT origen, nombre_ciudad FROM Destinos, Ciudades 
          WHERE origen = cid GROUP BY origen, nombre_ciudad;";
   
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_19 -> prepare($query);
	    $result -> execute();
	    $origenes = $result -> fetchAll();
    ?>
    <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Escoge el origen del viaje</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Origen</th>
                <th color = 'red' class="text-white bg-warning" scope="col">Consultar</th>
              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach ($origenes as $o) {
                  echo "<tr class='bg-dark'>
                          <td>$o[1]</td>
                          <td>
                          <form action='consulta_destinos.php' method='post' >
                              <input type = 'hidden' name = 'origen' id = 'origen' value = $o[1] >
                              <input type = 'hidden' name = 'oid' id = oid value = $o[0] >
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
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú Principal">
    </form>
  </div>
  <?php include('../templates/footer.html');?>

</html>
