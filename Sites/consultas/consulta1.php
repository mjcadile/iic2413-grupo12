<?php include('../templates/header.html');   ?>
<!--style>
header {
    background-color: blue;
}
h1 {text-align: center;}
p {text-align: center;}
</style!-->

<body>
  <div style= "background-image: url('https://gracemooreyoga.files.wordpress.com/2017/01/hja1uhg7b3ziilj4qie-g-wide.jpg');">
    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      #Se obtiene el valor del input del usuario
      #$altura = $_POST["altura"];
      #$altura = intval($altura);

      #Se construye la consulta como un string
 	    $query = "SELECT DISTINCT Obras.nombre FROM Obras;";
   
      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	    $result = $db -> prepare($query);
	    $result -> execute();
	    $nombres = $result -> fetchAll();
    ?>
    <div class="container mt-10">
      <h3 class="text-center mt-5 mb-5">Distintas obras de arte</h3>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped table-dark">
          <thead>
            <tr>
              <th class="bg-danger text-white" scope="col">Nombres</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($nombres as $n) {
                echo "<tr class='bg-dark text-white'>
                        <td>$n[0]</td>
                      </tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <form action="../index_copia.php" method="get">
      <input type="submit" class="btn btn-primary" value="Volver">
    </form>
  </div>

  <br>
  <br>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../js/actions.js"></script>
  <script src="js/actions.js"></script>
  
</body>

</html>


