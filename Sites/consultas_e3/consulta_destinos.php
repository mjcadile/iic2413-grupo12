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

    <?php include('../templates/footer.html');?>
  
</body>

</html>