<?php include('../templates/header.html');   ?>
</head style="text-align:center">

<h1>Distintas obras de arte</h1>

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

  <table border="1", align="center">
    <tr>
      <th>Nombres</th>
    </tr>
  
      <?php
        foreach ($nombres as $n) {
          echo "<tr><td>$n[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
