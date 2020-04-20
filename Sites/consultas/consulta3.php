<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $pais = $_POST["pais"];
  $searchVal = array("á", "é", "í", "ó", "ú", 'Á', "É", "Í", "Ó", "Ú");
  $replaceVal = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
  $pais = str_replace($searchVal, $replaceVal, $pais);
  $pais= strtolower($pais);

  #Se construye la consulta como un string
  $query = "SELECT DISTINCT Museos.nombre FROM (SELECT Lugares.nombre, Lugares.cid FROM 
  Museos, Obras, Lugares WHERE Obras.periodo = 'Renacimiento' AND Obras.lid = Museos.lid AND 
  Lugares.lid = Museos.lid) as Museos,  Ciudades, Paises WHERE  Museos.cid = Ciudades.cid AND 
  Ciudades.pid = Paises.pid AND LOWER(Paises.nombre) LIKE LOWER('%$pais%');";
 	#$query = "SELECT id, nombre, altura FROM ejercicio_ayudantia where altura>=$altura order by altura desc;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$nombres = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>nombres</th>
    </tr>
  
      <?php
        foreach ($nombres as $n) {
          echo "<tr><td>$n[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
