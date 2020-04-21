<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  #$altura = $_POST["altura"];
  #$altura = intval($altura);

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

<div class="container">
    <div class="modal show">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach ($nombres as $n) {
                                      echo "<tr><td>$n[0]</td></tr>";
                                    }
                                  ?>
                                </tbody>
                                <?php include('../templates/footer.html'); ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>