<?php include('../templates/header_sin_searchbox.html');   ?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<body>
  <img src="https://d2jv9003bew7ag.cloudfront.net/uploads/MoCP-Chicago.jpg" id="bg" alt="">
    <?php
      require("../config/conexion.php");

      $fecha_actual = date("Y-m-d", time());
      #Se construye la consulta como un string
 	    $query = "SELECT * FROM Artistas;";
   
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_12 -> prepare($query);
	    $result -> execute();
	    $nombres = $result -> fetchAll();
    ?>

      <div class="card text-center border-info mb-3">
          <form align="center" action="hacer_intinerario.php" method="post">
              <h5 class="text-center rounded-bottom bg-info text-white mb-8">Escoge la ciudad y la fecha de la consulta.</h5>
              <?php echo "
                <p class='card-text'> Ciudad </p>
                    <input type='text' name='ciudad'>
                <p class='card-text'> Fecha </p>
                    <input type='date' id='fecha' name='fecha'
                          value='$fecha_actual'
                          min='$fecha_actual' max='2025-12-31'>"?>
          </form>
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
                  $nombre = str_replace(' ', '+', $n[1]);
                  echo "<tr class='bg-dark'>
                          <td>$n[1]</td>˛
                          <td>
                          <form action='hacer_intinerario.php' method='post' >
                              <input type = 'hidden' name = 'nombre' id = 'nombre' value = $nombre >
                              <input type = 'hidden' name = 'aid' id = aid value = $n[0] >
                              <input type='checkbox' name='check_list[]' value='PHP'><label>$nombre</label><br/>
                          </form>
                          </td>
                        </tr>";
                }
  
              ?>
            </tbody>
          </table>
          <form action="hacer_intinerario.php" method="get">
              <input type='submit' class='btn btn-primary mt-2 mb-2' value='Consultar' />
          </form>
        </div>
      </div>
    </div>
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú Principal">
    </form>
  </div>
   <?php #include("templates/footer.html");?>

  