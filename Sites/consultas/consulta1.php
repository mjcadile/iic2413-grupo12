<?php include('../templates/header.html');   ?>
</head >
<style>
header {
    background-color: blue;
}
h1 {text-align: center;}
p {text-align: center;}
</style>

<h1>Distintas obras de arte </h1>

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

<div class="contanier">
  <table id="dtConsulta1" class="table tabel-striped table-bordered table-dark table-sm" cellspacing="0" 
    width="100%" border="1", align="center">
    <thead>
      <tr>
        <th class="th-sm">Nombres</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($nombres as $n) {
          echo "<tr><td>$n[0]</td></tr>";
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>Nombres
        </th>
      </tr>
    </tfoot>
  </table>
</div>

<?php include('../templates/footer.html'); ?>
