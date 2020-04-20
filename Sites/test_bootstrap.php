<!DOCTYPE html>
<html lang="en">
<head>

  <meta http-equiv="Content-Type" content="text/html">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title class="display-2">Prueba de Bootstrap</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

<p class="lead">
  En esta página se muetran distintas opciones para consultar sobre obras de arte alrededor del mundo.
  Hecho por José Baboun y Matías Cadile, grupo 12.
</p>

<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading text-center">
      <h2>DCConsultas</h2>
      <br>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-sm">
          <h5 name="Consulta 1">Mostrar todos los nombres distintos de las obras de arte:</h5>
          <button class="btn btn-primary" name="consulta1">Consultar</button>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col-sm">
          <h5 name="Consulta 2">Mostrar todos los nombres de las plazas que 
          contengan al menos una escultura de "Gian Lorenzo Bernini":</h5>
        </div>
        <div class="col-sm">
          <button class="btn btn-primary" name="consulta2">Consultar</button>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col-sm">
          <h5>Ingrese el nombre de un país</h5>
          <h6> A continuación se muestra el nombre de todos los museos 
          de ese país que tengan obras del renacimiento.</h6>
        </div>
        <div class="col-sm">
          <input type="text" class="form-control" name="Consulta 3">
          <button class="btn btn-primary" name="consulta3">Consultar</button>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col-sm">
          <h5>Para cada artista, se despliega su nombre y el número de obras en las que ha participado.</h5>
        </div>
        <div class="col-sm">
          <button class="btn btn-primary" name="consulta4">Consultar</button>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col-sm">
          <h5>Ingrese una hora de apertura en formato hh:mm:ss, una hora de cierre y una ciudad.</h5>
          <h6> A continuación se muestran los nombres de las iglesias 
          ubicadas en esa ciudad, abiertas entre esas horas (inclusive) 
          junto a todos los nombres de los frescos que encuentra en cada una de ellas.</h6>
        </div>
        <div class="col-sm">
          <input type="text" class="form-control" name="Consulta 5">
          <button class="btn btn-primary" name="consulta5">Consultar</button>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col-sm">  
          <h5>Se despliega el nombre de cada museo, plaza o iglesia 
          que tenga obras de todos los periodos del arte que existan en nuestro registro</h5>
        </div>
        <div class="col-sm">
          <button class="btn btn-primary" name="consulta6">Consultar</button>
        </div>
        <br>
        <br>
  
    </div>
    <div class="panel-footer"></div>
  </div>
</div>

</body>
</html>