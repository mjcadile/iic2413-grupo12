<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  #$altura = $_POST["altura"];
  #$altura = intval($altura);

  #Se construye la consulta como un string
 	$query = "SELECT Artistas.nombre, COUNT(Artistas.nombre) AS numero_obras FROM 
   Obras, Hecha_por, Artistas WHERE Obras.oid = Hecha_por.oid AND 
   Hecha_por.aid = Artistas.aid GROUP BY Artistas.nombre;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$tupla = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre</th>
      <th>Cantidad de Participaciones</th>
    </tr>
  
      <?php
        foreach ($tuplas as $t) {
          echo "<tr><td>$t[0]</td><td>$t[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
