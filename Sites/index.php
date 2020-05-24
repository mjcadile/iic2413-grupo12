<?php include('templates/header.html');?>

<body>
    <div class="card-deck mb-3">
        <div class="card">
            <img src="https://cdn2.excelsior.com.mx/media/styles/large/public/pictures/2020/03/16/2325247.jpg" 
            class="card-img-top" alt="imagen de Van Gogh">
            <div class="card-body">
            <h5 class="card-title">Artistas</h5>
            <p class="card-text">Aquí puedes encontrar el listado completo de los artistas. Podrás acceder a información detallada de cada uno de ellos.
                Haz click aquí.</p>
            <form align="center" action="consultas_e2/lista_artistas.php" method="post">
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
            <!--AGREGAR CONSULTA DE LISTADO DE OBRAS-->
            <form align="center" action="consultas_e2/lista_artistas.php" method="post">
                <input type="submit" class="btn btn-primary" value="ver más">
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
            <p class="card-text">Aqí podrás encontrar un listado completo de todos los lugares donde encontrar obras de arte, además 
                de conocer qué obras se pueden encontrar en cada uno de estos lugares.
            </p>
            <!--AGREGAR CONSULTA DE LISTADO DE LUGARES-->
            <form align="center" action="consultas_e2/lista_artistas.php" method="post">
                <input type="submit" class="btn btn-primary" value="Ver más">
            </form>
            </div>
            <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
    <?php include('templates/footer.html');?>