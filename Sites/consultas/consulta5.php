<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $h_apertura = $_POST["h_apertura"];
  $h_cierre = $_POST["h_cierre"];
  $ciudad = $_POST["ciudad"];
  $searchVal = array("á", "é", "í", "ó", "ú", 'Á', "É", "Í", "Ó", "Ú");
  $replaceVal = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
  $ciudad = str_replace($searchVal, $replaceVal, $ciudad);
  $ciudad= strtolower($ciudad);

  #Se construye la consulta como un string
 	$query = "SELECT Iglesias.nombre, Frescos.nombre FROM 
   (SELECT Lugares.lid, Lugares.nombre FROM Iglesias, Lugares,Ciudades 
   WHERE Iglesias.lid = Lugares.lid AND Lugares.cid = Ciudades.cid AND 
   Iglesias.horario_apertura <= '$h_apertura' AND Iglesias.horario_cierre >= '$h_cierre' 
   AND LOWER(Ciudades.nombre) LIKE LOWER('%$ciudad%')) AS Iglesias, (SELECT * FROM 
   Frescos, Obras WHERE Frescos.oid = Obras.oid) AS Frescos WHERE Frescos.lid = Iglesias.lid;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$tupla = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre Iglesia</th>
      <th>Nombre Fresco</th>
    </tr>
  
      <?php
        foreach ($tupla as $t) {
          echo "<tr><td>$t[0]</td><td>$t[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
