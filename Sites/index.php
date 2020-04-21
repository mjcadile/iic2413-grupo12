<?php include('templates/header.html');  
# http://codd.ing.puc.cl/~grupo12/index_copia.php? ?>

<body>
<img src="http://www.pxleyes.com/images/tutorials/submissionsteps/fullsize/1658_step3_4b35a144b19b5.jpg" id="bg" alt="">

  <h1 align="center" style="font-size:50px;color:white;">DCConsultas </h1>
  <p class="lead" style="text-align:center; color:white;">En esta página podrás encontrar información sobre obras de arte
  alrededor del mundo. <br>Hecho por José Baboun y Matías Cadile. <br/>Grupo12</p>

  <br>
  <hr>
  <h4 align="center" style="color:white;"> Mostrar todos los nombres distintos de las obras de arte:</h4>

  <form align="center" action="consultas/consulta1.php" method="post">
    <input type="submit" class="btn btn-primary" value="Consultar">
  </form>
  
  <br>
  <br>
  <br>

  <h4 align="center" style="color:white;"> Mostrar todos los nombres de las plazas que 
          contengan al menos una escultura de "Gian Lorenzo Bernini":</h4>

  <form align="center" action="consultas/consulta2.php" method="post">
    <br/><br/>
    <input type="submit" class="btn btn-primary" value="Consultar">
  </form>
  
  <br>
  <br>
  <br>

  <h4 align="center" style="color:white;"> A continuación se muestra el nombre de todos los museos 
          de un país que tenga obras del renacimiento.</h4>

  <form align="center" action="consultas/consulta3.php" method="post">
    Ingrese el nombre del país que quiera consultar:
    <input type="text" class="form-control form-rounded" name="pais">
    <br/><br/>
    <input type="submit" class="btn btn-primary" value="Consultar">
  </form>
  <br>
  <br>
  <br>

  <h4 align="center" style="color:white;">Para cada artista, se despliega su nombre y el número de obras en las que ha participado.</h4>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  #require("config/conexion.php");
  #$result = $db -> prepare("SELECT DISTINCT tipo FROM ejercicio_ayudantia;");
  #$result -> execute();
  #$dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta4.php" method="post">
    <br><br>
    <input type="submit" class="btn btn-primary" value="Consultar">
  </form>

  <br>
  <br>
  <br>
  <br>

  <h4 align="center" style="color:white;"> A continuación se muestran los nombres de las iglesias 
          ubicadas en cierta ciudad, abiertas entre ciertas horas (inclusive) 
          junto a todos los nombres de los frescos que se encuentran en cada una de ellas.</h4>

  <form align="center" action="consultas/consulta5.php" method="post">
    Ingrese una hora de apertura (formato hh:mm:ss):
    <input type="text" class="form-control form-rounded" name="h_apertura">
    <br/><br/>
    Ingrese una hora de cierre (formato hh:mm:ss):
    <input type="text" class="form-control form-rounded" name="h_cierre">
    <br/><br/>
    Ingrese una ciudad:
    <input type="text" class="form-control form-rounded" name="ciudad">
    <br/><br/>
    <input type="submit" class="btn btn-primary" value="Consultar">
  </form>
  
  <br>
  <br>
  <br>

  <h4 align="center" style="color:white;"> Se despliega el nombre de cada museo, plaza o iglesia 
          que tenga obras de todos los periodos del arte que existan en nuestro registro</h4>

  <form align="center" action="consultas/consulta6.php" method="post">
    <br/><br/>
    <input type="submit" class="btn btn-primary" value="Consultar">
  </form>
  
  <br>
  <br>
  <br>
  
</body>
</html>
