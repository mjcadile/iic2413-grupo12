<?php 
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
          include('../templates/header_sin_searchbox_login.html');
}else{
    include('../templates/header_sin_searchbox.html');
}?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");
    
      $seleccionado = $_POST["aid"];
      $nombre_artista = $_POST["nombre"];
      $seleccionado = number_format($seleccionado);
      #Se construye la consulta como un string
      $query = "SELECT * FROM Artistas WHERE Artistas.aid = '$seleccionado'";
     
   
      $query_obras = "SELECT Obras.oid, Obras.nombre, Obras.ano_inicio, Obras.ano_termino, Obras.periodo
      FROM Artistas, Hecha_por, Obras WHERE Artistas.aid = Hecha_por.aid 
      AND Hecha_por.oid = Obras.oid AND Artistas.aid = '$seleccionado'";

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_12 -> prepare($query);
	    $result -> execute();
      $resultados = $result -> fetchAll();
      
      $result_o = $db_12 -> prepare($query_obras);
	    $result_o -> execute();
      $obras = $result_o -> fetchAll();
      
      $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=large&q=";
      $q = "{$nombre_artista}";
      $q = str_replace(" ", "+", $q);
      $url = $base . $q;

      $response = file_get_contents($url);
      $manage = json_decode($response, true);
      print_r ($image);
      $image = $manage["items"][1]["link"];

      ?>
  <img src= <?php echo $image ?> id="bg" alt="">
      

    <div class= 'container mt-10'>
      <h2 class="text-center rounded-bottom bg-info text-white mb-8"> Información de <?php $nombre_artista; ?></h2>
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
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td><td>$n[3]</td>
                        </tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Obras del artista</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col" >ID </th>
                <th class="text-white bg-danger" scope="col">Nombre</th>
                <th class="text-white bg-danger" scope="col">Ano Inicio</th>
                <th class="text-white bg-danger" scope="col">Ano de término</th>
                <th class="text-white bg-danger" scope="col">Periodo</th>
                <th class="text-white bg-danger" scope="col">Consultar</th>



              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($obras as $n) {
                  $nombre = str_replace(' ', '+', $n[1]);
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td><td>$n[1]</td><td>$n[2]</td><td>$n[3]</td><td>$n[4]</td> <td>
                          <form action='consulta_obras.php' method='post' >
                              <input type = 'hidden' name = 'nombre' id = 'nombre' value = $nombre >
                              <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
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
    <form action="lista_artistas.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Volver al listado de artistas">
    </form>
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú principal">
    </form>
  </div>
  <?php include('../templates/footer.html');?>