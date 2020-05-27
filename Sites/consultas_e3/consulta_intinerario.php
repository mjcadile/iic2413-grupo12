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
  <img src="https://d2jv9003bew7ag.cloudfront.net/uploads/MoCP-Chicago.jpg" id="bg" alt="">
    <?php
      require("../config/conexion.php");

      $fecha_actual = date("Y-m-d", time());
      #Consulta nombre de artistas
 	    $query = "SELECT * FROM Artistas;";
	    $result = $db_12 -> prepare($query);
	    $result -> execute();
      $nombres = $result -> fetchAll();
      #Consulta nombre ciudades
      $query_ciudades = "SELECT nombre_ciudad, cid FROM Ciudades;";
      $result_ciudades = $db_19 -> prepare($query_ciudades);
      $result_ciudades -> execute();
      $ciudades = $result_ciudades -> fetchAll();
    ?>

      <div class="card-deck mb-3">
          <div class="card">
          <form align="center" action="hacer_intinerario.php" method="post">
              <h5 class="text-center rounded-bottom bg-info text-white mb-8">Escoge la ciudad y la fecha de la consulta.</h5>
              <p class='card-text'> Ciudad </p>
                  <select name='ciudad'>
                      <option value='0'>Seleciona la ciudad de origen</option>
                      <?php foreach ($ciudades as $c){
                          echo "<option value='$c[1]'>$c[0]</option>";             
                      }?>
                  </select>
              <?php echo "
                <p class='card-text'> Fecha </p>
                    <input type='date' id='fecha' name='fecha'
                          value='$fecha_actual'
                          min='$fecha_actual' max='2025-12-31'>";?>
          </div>
      </div>

    <div class="container-fluid mt-10">
      <h5 class="text-center rounded-bottom bg-info text-white mb-8">Escoge a los artistas que deseas visitar.</h5>
      <div class="scrollable"> 
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre Artista</th>
                <th color = 'red' class="text-white bg-warning" scope="col">Consultar</th>

              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach ($nombres as $n) {
                  $nombre = $n[1];
                  echo "<tr class='bg-dark'>
                          <td>$n[1]</td>˛
                          <td>
                              <input type='checkbox' name='check_list[]' value='$nombre'><br/>
                          </td>
                        </tr>";
                }
  
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card text-center border-info mb-3">
        <input type='submit' class='btn btn-primary mt-2 mb-2' value='Consultar' />
    </div>
    </form>
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú Principal">
    </form>
  </div>
   <?php #include("templates/footer.html");?>

  