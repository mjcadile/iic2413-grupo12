<?php 
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
          include('../templates/header_sin_searchbox_login.html');
}else{
    include('../templates/header_sin_searchbox.html');
}?>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<body>
    <div class="card text-center border-info mb-3">
      <img src="https://d2jv9003bew7ag.cloudfront.net/uploads/MoCP-Chicago.jpg" id="bg" alt="">
          <?php
          $fecha_viaje = $_POST["fecha"];
          $cid = $_POST["ciudad"];
          $cid = number_format(intval($cid));
          echo $ciudad."</br>";
          echo $fecha_viaje."</br>";
          foreach($_POST['check_list'] as $selected){
            echo $selected."</br>";
          }

          $query = "SELECT itinerario($cid, 24);";
          $result = $db_19 -> prepare($query);
          $result -> execute();
          $intine = $result -> fetchAll();

          $query_int = "SELECT * FROM Itinerario;";
          $result_int = $db_19 -> prepare($query_int);
          $result_int -> execute();
          $intinerario = $result_int -> fetchAll();

          foreach($intinerario as $i){
            if (isset(i[0])){
              echo $i[0]."</br>";
            }
            if (isset(i[1])){
              echo $i[1]."</br>";
            }
            if (isset(i[2])){
              echo $i[2]."</br>";
            })
            


          }
          
        ?>
    </div>
<body>

  