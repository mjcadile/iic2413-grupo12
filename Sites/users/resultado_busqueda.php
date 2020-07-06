<?php
session_start();
include('../templates/header_sin_searchbox_login_msj.html');
require("../config/conexion.php");


if (isset($_POST['search'])){
    echo "<div class='card'>
            <br>
              <div class='card-body'>
                <h5 class='card-title'>Funciona!</h5>
              </div>
            <br>
          </div>
          <br>";
}

?>
<br>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<img src="https://wallpaperaccess.com/full/2048343.jpg" id="bg" alt="">

<?php include('../templates/footer.html');?>