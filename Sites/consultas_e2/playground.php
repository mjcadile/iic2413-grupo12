<?php include('../templates/header_sin_searchbox.html');   
  
$api_key = 'AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs';


$base = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=xlarge&q=";
$q = "museo+del+prado";
$url = $base . $q;

$response = file_get_contents($url);
$manage = json_decode($response, true);
print_r ($image);
$image = $manage["items"][0]["link"];

#$response = file_get_contents("https://www.googleapis.com/customsearch/v1?key=AIzaSyDgUQYUdFbUysJn5NrrxwRl8CTuo57pxAs&cx=003942152785230116418:kpfrdxsnbkh&searchType=image&imgSize=large&q=");


#echo $response;



?>

<body>
  <!--div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');"!-->
  
  <img src= <?php echo $image?> id="bg" alt="">
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
  <?php include('templates/footer.html');?>