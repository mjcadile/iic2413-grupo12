<?php
session_start();
include('../templates/header_sin_searchbox_login_msj.html');
require("../config/conexion.php");
?>

<form action='resultado_busqueda.php' method='post'>
  <?php
    echo "<div class='card'>
            <br>
              <div class='card-body'>
                <h5 class='card-title'>Frase que deseablemente esté en el mensaje:</h5>
                <input name='search[]' type='text' placeholder='Escribe aquí'>
              </div>
            <br>
          </div>
          <br>";


    echo "<div class='card'>
            <br>
              <div class='card-body'>
                <h5 class='card-title'>Frase que debe estar en el mensaje:</h5>
                <input name='search[]' type='text' placeholder='Escribe aquí'>
              </div>
            <br>
          </div>
          <br>";


    echo "<div class='card'>
            <br>
              <div class='card-body'>
                <h5 class='card-title'>Palabras que no pueden estar en el mensaje:</h5>
                <input name='search[]' type='text' placeholder='Escribe aquí'>
              </div>
            <br>
          </div>
          <br>";


    echo "<div class='card'>
            <br>
              <div class='card-body'>
                <h5 class='card-title'>id del usuario emisor del mensaje:</h5>
                <input name='search[]' type='text' placeholder='Escribe aquí'>
              </div>
            <br>
          </div>
          <br>";
  ?>

  <input type='submit' value='Buscar'>
</form>
<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>