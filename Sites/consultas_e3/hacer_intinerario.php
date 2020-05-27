<?php include('../templates/header_sin_searchbox.html');   ?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<body>
    <div class="card text-center border-info mb-3">
      <img src="https://d2jv9003bew7ag.cloudfront.net/uploads/MoCP-Chicago.jpg" id="bg" alt="">
          <?php
          $fecha_viaje = $_POST["fecha"];
          $ciudad = $_POST["ciudad"];
          echo $ciudad."</br>";
          echo $fecha_viaje."</br>";
          foreach($_POST['check_list'] as $selected){
            echo $selected."</br>";
          }
        ?>
    </div>
<body>

  