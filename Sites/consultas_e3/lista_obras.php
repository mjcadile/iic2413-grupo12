<?php 
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
          include('../templates/header_sin_searchbox_login.html');
}else{
    include('../templates/header_sin_searchbox.html');
}?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="https://d2jv9003bew7ag.cloudfront.net/uploads/MoCP-Chicago.jpg" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      #Se construye la consulta como un string
 	    $query = "SELECT * FROM Obras;";
   
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db_12 -> prepare($query);
	    $result -> execute();
	    $nombres = $result -> fetchAll();
    ?>
    <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Todas las Obras</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre Obra</th>
                <th color = 'red' class="text-white bg-warning" scope="col">Consultar</th>

              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach ($nombres as $n) {
                  $nombre = $n[1];
                  #$nombre = str_replace(' ', '+', $n[1]);
                  echo "<tr class='bg-dark'>
                          <td>$nombre</td>
                          <td>
                          <form action='consulta_obras.php' method='post' >
                              <input type = 'hidden' name = 'nombre' id = 'nombre' value = $nombre >
                              <input type = 'hidden' name = 'oid' id = oid value = $n[0] >
                              <input class='btn btn-primary' type='submit' value='Conocer más'>
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
   <?php include("../templates/footer.html");?>