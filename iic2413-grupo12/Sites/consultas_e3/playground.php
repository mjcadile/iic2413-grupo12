<?php include('../templates/header.html');   
  $base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=huge&q=";

  $q = "museo del prado";
  $query = [
      "engine" => "google",
      "ijn" => "0",
      "q" => "museo del louvre",
      "google_domain" => "google.com",
      "tbm" => "isch",
      "api_key" => "AIzaSyAT7rmXtANwQfI7SV9Xjd-v8zX3AoNZX2I"
  ];
  $api_key = 'AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs';
  
$response = file_get_contents("https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&q=museo+del+louvre&searchType=image&imgSize=huge");

$manage = json_decode($response, true);


#echo $response;
print_r ($manage["items"][0]["link"]);

  
?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  
  <img src="http://www.museivaticani.va/content/dam/museivaticani/immagini/collezioni/musei/pinacoteca/17_01_angelo_destra_dettaglio.jpg/jcr:content/renditions/cq5dam.web.1280.1280.jpeg" id="bg" alt="">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      #Se construye la consulta como un string
 	    $query = "SELECT Plazas.nombre FROM (SELECT 
         Lugares.lid, Lugares.nombre FROM Lugares, Plazas WHERE Plazas.lid = Lugares.lid) as 
         Plazas,  (SELECT Esculturas.oid, Obras.lid FROM Esculturas, Obras, Hecha_por, 
         Artistas WHERE Artistas.nombre = 'Gian Lorenzo Bernini' AND Esculturas.oid = Hecha_por.oid AND 
         Hecha_por.aid = Artistas.aid AND Obras.oid = Esculturas.oid) as Foo WHERE Foo.lid = Plazas.lid;";
   
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db -> prepare($query);
	    $result -> execute();
	    $nombres = $result -> fetchAll();
    ?>
    <div class="container mt-10">
      <h2 class="text-center rounded-bottom bg-info text-white mb-8">Plazas con al menos una escultura de Gian L. Bernini</h2>
      <div class="scrollable">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped text-center table-dark">
            <thead>
              <tr>
                <th class="text-white bg-danger" scope="col">Nombre Plaza</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($nombres as $n) {
                  echo "<tr class='bg-dark'>
                          <td>$n[0]</td>
                        </tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <form action="../index.php" method="get">
      <input type="submit" class="btn btn-primary mt-8 mb-5" value="Volver">
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../js/actions.js"></script>
  <script src="js/actions.js"></script>
  
</body>

</html>