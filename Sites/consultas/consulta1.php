<?php include('../templates/header.html');   ?>

<body>
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

  <table>
    <tr>
      <th>Nombre</th>
    </tr>
  
      <?php
        foreach ($nombre as $n) {
          echo "<tr><td>$p[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
