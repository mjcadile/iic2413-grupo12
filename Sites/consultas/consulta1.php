<?php include('../templates/header.html');   ?>
</head >
<style>
h1 {text-align: center;}
p {text-align: center;}
</style>

<h1>Distintas obras de arte 2</h1>

<body>
<h1 style="colour: blue; font-size:16px">Big Heading</h1>
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
