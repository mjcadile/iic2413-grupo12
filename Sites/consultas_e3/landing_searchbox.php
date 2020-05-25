<?php include('templates/header_sin_searchbox.html');   ?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  <img src="" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("config/conexion.php");

      #Se guarda lo que viene de index.php
      $palabra = $_POST["searchbox"];

       # $_POST["opcion_1"] --> artistas
       # $_POST["opcion_2"] --> obras
       # $_POST["opcion_3"] --> lugares
      
      #Se crean las consultas correspondientes
      $query_obras = "SELECT DISTINCT Obras.oid, Obras.nombre, Ciudades.nombre, Paises.nombre
      FROM Obras, Lugares, Ciudades, Paises WHERE  Obras.lid = Lugares.lid AND Lugares.cid = Ciudades.cid AND
       Ciudades.pid = Paises.pid AND LOWER(Obras.nombre) LIKE LOWER('%$busqueda%');";

      $query_artistas = "SELECT DISTINCT Artistas.aid, Artistas.nombre
      FROM Artistas WHERE LOWER(Artistas.nombre) LIKE LOWER('%$busqueda%');";

      $query_lugares = "SELECT DISTINCT Lugares.lid, Lugares.nombre, Ciudades.nombre, Paises.nombre
      FROM Lugares, Ciudades, Paises WHERE  Lugares.lid = Lugares.lid AND Lugares.cid = Ciudades.cid AND
      Ciudades.pid = Paises.pid AND LOWER(Lugares.nombre) LIKE LOWER('%$busqueda%');";
        
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
      $result = $db_12 -> prepare($query_obras);
      $result -> execute();
      $obras = $result -> fetchAll();
      
      $result = $db_12 -> prepare($query_artistas);
      $result -> execute();
      $artistas = $result -> fetchAll();
      
      $result = $db_12 -> prepare($query_lugares);
      $result -> execute();
      $lugares = $result -> fetchAll();


      $header_artistas = "<div class='container-fluid mt-10'>
      <h2 class='text-center rounded-bottom bg-info text-white mb-8'>Búsqueda de artistas</h2>
      <div class='scrollable'>
        <div class='table-responsive'>
          <table class='table table-bordered table-hover table-striped text-center table-dark'>
            <thead>
              <tr>
                <th class='text-white bg-danger' scope='col' >Nombre</th>
                <th color = 'red' class='text-white bg-warning' scope='col'>Consultar</th>
              </tr>
            </thead>
          <tbody>";
      
      $header_lugares = "<div class='container-fluid mt-10'>
      <h2 class='text-center rounded-bottom bg-info text-white mb-8'>Búsqueda de lugares</h2>
      <div class='scrollable'>
        <div class='table-responsive'>
          <table class='table table-bordered table-hover table-striped text-center table-dark'>
            <thead>
              <tr>
                <th class='text-white bg-danger' scope='col'>Lugar</th>
                <th class='text-white bg-danger' scope='col'>Ciudad</th>
                <th class='text-white bg-danger' scope='col'>País</th>
                <th color = 'red' class='text-white bg-warning' scope='col'>Consultar</th>
              </tr>
            </thead>
          <tbody>";
      
      $header_obras = "<div class='container-fluid mt-10'>
      <h2 class='text-center rounded-bottom bg-info text-white mb-8'>Búsqueda de obras</h2>
      <div class='scrollable'>
        <div class='table-responsive'>
          <table class='table table-bordered table-hover table-striped text-center table-dark'>
            <thead>
              <tr>
                <th class='text-white bg-danger' scope='col'>Obra</th>
                <th class='text-white bg-danger' scope='col'>Ciudad</th>
                <th class='text-white bg-danger' scope='col'>País</th>
                <th color = 'red' class='text-white bg-warning' scope='col'>Consultar</th>
              </tr>
            </thead>
          <tbody>";

    ?>
    <?php
    #solo lugares
      if (empty($_POST["opcion_1"]) and empty($_POST["opcion_2"]) and empty($_POST["opcion_3"]) == FALSE) { 
        echo $header_lugares;
                    foreach ($lugares as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>$n[2]</td>
                              <td>$n[3]</td>
                              <td>
                              <form action='consultas_e3/consulta_lugares.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'lid' id = 'lid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre este lugar'>
                              </form>
                              </td>
                            </tr>";
                    }
        echo 
              "</tbody>
               </table>
            </div>
          </div>
        </div>";
      }
      #solo obras
      elseif (empty($_POST["opcion_1"]) and empty($_POST["opcion_2"]) == FALSE and empty($_POST["opcion_3"])){ 
        echo $header_obras;
                    foreach ($obras as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>$n[2]</td>
                              <td>$n[3]</td>
                              <td>
                              <form action='consultas_e3/consulta_obras.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre esta obra'>
                              </form>
                              </td>
                            </tr>";
                    }
        echo 
              "</tbody>
               </table>
            </div>
          </div>
        </div>";
      }
      #solo artistas
      elseif (empty($_POST["opcion_1"]) == FALSE and empty($_POST["opcion_2"]) and empty($_POST["opcion_3"])) { 
        echo $header_artistas;
                    foreach ($artistas as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>
                              <form action='consultas_e3/consulta_artistas.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'aid' id = 'aid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre este artista'>
                              </form>
                              </td>
                            </tr>";
                    }
        echo 
              "</tbody>
               </table>
            </div>
          </div>
        </div>";
      }
      #lugares y artistas
      elseif (empty($_POST["opcion_1"]) == FALSE and empty($_POST["opcion_2"]) and empty($_POST["opcion_3"]) == FALSE) { 
        echo $header_lugares;
                    foreach ($lugares as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>$n[2]</td>
                              <td>$n[3]</td>
                              <td>
                              <form action='consultas_e3/consulta_lugares.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'lid' id = 'lid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre este lugar'>
                              </form>
                              </td>
                            </tr>";
                    }
          echo 
                "</tbody>
                 </table>
              </div>
            </div>
          </div>
          <br>
          <br>";
          
          echo $header_artistas;
                      foreach ($artistas as $n) {
                        echo "<tr class='bg-dark'>
                                <td>$n[1]</td>
                                <td>
                                <form action='consultas_e3/consulta_artistas.php' method='post' >
                                    <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                    <input type = 'hidden' name = 'aid' id = 'aid' value = $n[0] >
                                    <input class='btn btn-primary' type='submit' value='Sobre este artista'>
                                </form>
                                </td>
                              </tr>";
                      }
          echo 
                  "</tbody>
                  </table>
                </div>
              </div>
            </div>";

      }
      #lugares y obras
      elseif (empty($_POST["opcion_1"]) and empty($_POST["opcion_2"]) == FALSE and empty($_POST["opcion_3"]) == FALSE) {
        echo $header_lugares;
                    foreach ($lugares as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>$n[2]</td>
                              <td>$n[3]</td>
                              <td>
                              <form action='consultas_e3/consulta_lugares.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'lid' id = 'lid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre este lugar'>
                              </form>
                              </td>
                            </tr>";
                    }
          echo 
                "</tbody>
                 </table>
              </div>
            </div>
          </div>
          <br>
          <br>";

          echo $header_obras;
                    foreach ($obras as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>$n[2]</td>
                              <td>$n[3]</td>
                              <td>
                              <form action='consultas_e3/consulta_obras.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre esta obra'>
                              </form>
                              </td>
                            </tr>";
                    }
        echo 
              "</tbody>
               </table>
            </div>
          </div>
        </div>";
      }
      #artistas y obras
      elseif (empty($_POST["opcion_1"]) == FALSE and empty($_POST["opcion_2"]) == FALSE and empty($_POST["opcion_3"])) {
        echo $header_artistas;
                    foreach ($artistas as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>
                              <form action='consultas_e3/consulta_artistas.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'aid' id = 'aid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre este artista'>
                              </form>
                              </td>
                            </tr>";
                    }
        echo 
              "</tbody>
               </table>
            </div>
          </div>
        </div>
        <br>
        <br>";

        echo $header_obras;
                    foreach ($obras as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>$n[2]</td>
                              <td>$n[3]</td>
                              <td>
                              <form action='consultas_e3/consulta_obras.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre esta obra'>
                              </form>
                              </td>
                            </tr>";
                    }
        echo 
              "</tbody>
               </table>
            </div>
          </div>
        </div>";
      }
      elseif (empty($_POST["opcion_1"]) == FALSE and empty($_POST["opcion_2"]) == FALSE and empty($_POST["opcion_3"]) == FALSE) {
        echo $header_lugares;
                    foreach ($lugares as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>$n[2]</td>
                              <td>$n[3]</td>
                              <td>
                              <form action='consultas_e3/consulta_lugares.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'lid' id = 'lid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre este lugar'>
                              </form>
                              </td>
                            </tr>";
                    }
          echo 
                "</tbody>
                 </table>
              </div>
            </div>
          </div>
          <br>
          <br>";

          echo $header_obras;
                    foreach ($obras as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>$n[2]</td>
                              <td>$n[3]</td>
                              <td>
                              <form action='consultas_e3/consulta_obras.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'oid' id = 'oid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre esta obra'>
                              </form>
                              </td>
                            </tr>";
                    }
        echo 
              "</tbody>
               </table>
            </div>
          </div>
        </div>
        <br>
        <br>";

        echo $header_artistas;
                    foreach ($artistas as $n) {
                      echo "<tr class='bg-dark'>
                              <td>$n[1]</td>
                              <td>
                              <form action='consultas_e3/consulta_artistas.php' method='post' >
                                  <input type = 'hidden' name = 'nombre' id = 'nombre' value = $n[1] >
                                  <input type = 'hidden' name = 'aid' id = 'aid' value = $n[0] >
                                  <input class='btn btn-primary' type='submit' value='Sobre este artista'>
                              </form>
                              </td>
                            </tr>";
                    }
        echo 
              "</tbody>
               </table>
            </div>
          </div>
        </div>";
      }
      else {
        echo "<div id='myModal' class='modal fade'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title'>No se han podido encontrar referencias</h4>
                </div>
                <div class='modal-body'>
                    <p>Revisa que al menos una checkbox esté marcada.</p>
                    <p>De lo contrario, se puede deber a un error en la página.</p>
                    <form action='../index.php' method='get'>
                      <input type='submit' class='btn btn-primary mt-8 mb-5' value='Volver al menú'>
                    </form>
                </div>
            </div>
        </div>
    </div>";
      }
    ?>
  <?php include('templates/footer.html');?>