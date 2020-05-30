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
          $fecha_viaje = $_POST["fecha"];
          $cid = $_POST["ciudad"];
          $horas = $_POST["horas"];
          $cid = intval($cid);
          $horas = intval($horas);
          if (isset($_POST['check_list'])){
              $artistas = "ARRAY[";
              foreach($_POST['check_list'] as $selected){
                $artistas .= "'";
                $artistas .= $selected;
                $artistas .= "'";
                $artistas .= ",";
              }
              $artistas = substr($artistas, 0, -1); 
              $artistas .= "]";
              $query = "SELECT itinerario('$cid', '$horas', '$fecha_viaje', $artistas);";
              $result = $db_19 -> prepare($query);
              $result -> execute();

          
              $query_int = "SELECT * FROM Itinerario_final ORDER BY precio_total;";
              $result_int = $db_19 -> prepare($query_int);
              $result_int -> execute();
              $itinerario = $result_int -> fetchAll();
          }
          ?>

      <div class="container-fluid mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Itinerarios</h2>
      <div class="card">
            <?php 
            if (isset($mensaje)){
                echo "<h7 class='text-center rounded-bottom bg-info text-white mb-8'>$mensaje</h7>";
            }?>
      </div>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Itinerario</th>
                <th class="text-white bg-danger" scope="col">Origen</th>
                <th class="text-white bg-danger" scope="col">Destino</th>
                <th class="text-white bg-danger" scope="col">Hora de salida</th>
                <th class="text-white bg-danger" scope="col">Fecha de salida</th>
                <th class="text-white bg-danger" scope="col">Hora de llegada</th>
                <th class="text-white bg-danger" scope="col">Fecha de llegada</th>
                <th class="text-white bg-danger" scope="col">Medio</th>
                <th class="text-white bg-danger" scope="col">Precio</th>
                <th class="text-white bg-danger" scope="col">Precio Itinerario</th>
              </tr>
            </thead>
            <tbody>
              
              <?php
              if (isset($itinerario)){
                $contador = 1;
                foreach ($itinerario as $i) {
                  echo "<tr class='bg-dark'>
                            <td>$contador</td><td>$i[0]</td><td>$i[1]</td><td>$i[4]</td><td>$i[10]</td><td>$i[7]</td><td>$i[13]</td><td>$i[16]</td><td>$i[19]</td><td>$i[22]</td>
                        </tr>";
                  if (isset($i[2])){
                    echo "<tr class='bg-dark'>
                    <td></td><td>$i[1]</td><td>$i[2]</td><td>$i[5]</td><td>$i[11]</td><td>$i[8]</td><td>$i[14]</td><td>$i[17]</td><td>$i[20]</td><td></td>
                      </tr>";
                    }
                  if (isset($i[3])){
                      echo "<tr class='bg-dark'>
                      <td></td><td>$i[2]</td><td>$i[3]</td><td>$i[6]</td><td>$i[12]</td><td>$i[9]</td><td>$i[15]</td><td>$i[18]</td><td>$i[21]</td><td></td>
                        </tr>";
                      }
                  echo "<tr class='bg-secondary' style='border-bottom:1px solid white'>
                      <td colspan='100%'></td>
                  </tr>";    
                  $contador ++;
                }  
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
  </div>
<body>


  