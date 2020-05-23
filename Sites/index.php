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
            <a class="navbar-brand" href="#">Bienvenidos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="consultas_e2.php">Consultas E2</a>
                    </li>
                <!--li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Consultas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="consultas_e3/lista_artistas.php">Consulta 1</a>
                    <a class="dropdown-item" href="#">Consulta 2</a>
                    <a class="dropdown-item" href="#">Consulta 3</a>
                    <a class="dropdown-item" href="#">Consulta 4</a>
                    <a class="dropdown-item" href="#">Consulta 5</a>
                    <a class="dropdown-item" href="#">Consulta 6</a>
                    </div>
                </li-->
                </ul>
            </div>
        </nav>
    </div>
<body>
    <div class="card mb-3">
        <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.viajeselcorteingles.es%2Fblog%2Fdestinos%2Ftras-los-pasos-de-leonardo-da-vinci%2F&psig=AOvVaw3eLtOdFD4beB-sGbDEK04n&ust=1590303101896000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCMj7vPayyekCFQAAAAAdAAAAABAD" 
        class="card-img-top" alt="da Vinci">
        <div class="card-body">
            <h5 class="card-title">Todos los artistas</h5>
            <p class="card-text">Haz click aquí para conocer el listado de todos los artistas.</p>
            <p class="card-text"><small class="text-muted">Last updated now</small></p>
            <form align="center" action="consultas_e3/lista_artistas.php" method="post">
                <input type="submit" class="btn btn-primary" value="Ir a la página">
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>