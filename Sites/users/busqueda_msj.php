<?php
session_start();
include('../templates/header_sin_searchbox_login_msj.html');
require("../config/conexion.php");

echo "<div class='card'>
      <br>
          <div class='card-body'>
            <h4 class='card-title'>Frase que deseablemente esté en el mensaje</h4>
          </div>
          <br>
      </div>
      <br>";

echo "<html>
        <body>

          <form action='busqueda_msj.php' method='GET'>
            <input id='search' name='search' type='text' placeholder='Type here'>
            <input id='submit' type='submit' value='Search'>
          </form>
        </body>
      </html>";

?>
<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>