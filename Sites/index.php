<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] != "Contraseña erronea" && 
        $_SESSION['user'] != "Usuario no encontrado" && $_SESSION['user'] != "error username" && 
        $_SESSION['user'] != "error contraseña"){
    include('templates/header_login.html');
}else{
    include('templates/header.html');
}?>


<body>
    <div class="card-deck mb-3">
        <div class="card">
            <img src="https://cdn2.excelsior.com.mx/media/styles/large/public/pictures/2020/03/16/2325247.jpg" 
            class="card-img-top" alt="imagen de Van Gogh">
            <div class="card-body">
            <h5 class="card-title">Artistas</h5>
            <p class="card-text">Aquí puedes encontrar el listado completo de los artistas. Podrás acceder a información detallada de cada uno de ellos.
                Haz click aquí.</p>
            <form align="center" action="consultas_e3/lista_artistas.php" method="post">
                <input type="submit" class="btn btn-primary" value="Ver más">
            </form>
            </div>
            <div class="card-footer">
            <small class="text-muted">Last updated now</small>
            </div>
        </div>
        <div class="card">
            <img src="https://dam.ngenespanol.com/wp-content/uploads/2019/07/El-Grito-Munch.png" class="card-img-top" alt="imagen obra El Grito">
            <div class="card-body">
            <h5 class="card-title">Obras</h5>
            <p class="card-text">Haz click aquí para conocer el listado completo de obras: pinturas, frescos y esculturas.
                Además, podrás conocer información detallada de cada una de estas.
            </p>
            <form align="center" action="consultas_e3/lista_obras.php" method="post">
                <input type="submit" class="btn btn-primary" value="Ver más">
            </form>
            </div>
            <div class="card-footer">
            <small class="text-muted">Last updated now</small>
            </div>
        </div>
        <div class="card">
            <img src="https://okdiario.com/img/2019/09/15/obras-mas-importantes-de-miguel-angel.jpg" class="card-img-top" alt="capilla sixtina">
            <div class="card-body">
            <h5 class="card-title">Lugares</h5>
            <p class="card-text">Aquí podrás encontrar un listado completo de todos los lugares donde encontrar obras de arte, además 
                de conocer qué obras se pueden encontrar en cada uno de estos lugares.
            </p>
            <form align="center" action="consultas_e3/lista_lugares.php" method="post">
                <input type="submit" class="btn btn-primary" value="Ver más">
            </form>
            </div>
            <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img src="https://www.turismoenchile.cl/images/blog/15057073463.jpg" class="card-img-top" alt="hotel">
            <div class="card-body">
            <h5 class="card-title">Hoteles</h5>
            <p class="card-text">Aquí puedes encontrar el listado completo de los hoteles. Ademas podras reservar en el hotel que desees.
                Haz click aquí.
            </p>
            <form align="center" action="consultas_e3/lista_hoteles.php" method="post">
                <input type="submit" class="btn btn-primary" value="Ver más">
            </form>
            </div>
            <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img src="https://data.whicdn.com/images/181253905/original.jpg" class="card-img-top" alt="viaje avion">
            <div class="card-body">
            <h5 class="card-title">Viajar</h5>
            <p class="card-text">Aquí puedes comprar tus tickets de viajes.
                Haz click aquí.
            </p>
            <form align="center" action="consultas_e3/lista_origenes.php" method="post">
                <input type="submit" class="btn btn-primary" value="Ver más">
            </form>
            </div>
            <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
    <?php include('templates/footer.html');?>