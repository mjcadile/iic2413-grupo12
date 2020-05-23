<?php include('templates/header.html');?>
<style>

hr.new1 {
  border-top: 2px solid white;
}
</style>

<!--Título y Navbar-->
<img src="https://upload.wikimedia.org/wikipedia/commons/5/5b/Michelangelo_-_Creation_of_Adam_%28cropped%29.jpg" id="bg" alt="">
    <div class="card border-info mb-4">
        <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/5/5b/Michelangelo_-_Creation_of_Adam_%28cropped%29.jpg" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">Splinter S.A</h2>
            <p class="card-text">Proyecto realizado por José Baboun y Matías Cadile, IIC2413.</p>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="consultas_e2.php">Consultas E2</a>
                    </li>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </ul>
                <ul class="navbar-nav">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="consultas_e2.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="consultas_e2.php">Register</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
<body>
    <div class="card-deck">
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
            <!--AGREGAR CONSULTA DE LISTADO DE OBRAS-->
            <form align="center" action="consultas_e3/lista_artistas.php" method="post">
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
            <form align="center" action="consultas_e3/lista_artistas.php" method="post">
                <input type="submit" class="btn btn-primary" value="Ver más">
            </form>
            </div>
            <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>