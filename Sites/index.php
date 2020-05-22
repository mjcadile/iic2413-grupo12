<?php include('templates/header.html');?>
<style>

hr.new1 {
  border-top: 2px solid white;
}
</style>
<body>
<img src="https://upload.wikimedia.org/wikipedia/commons/5/5b/Michelangelo_-_Creation_of_Adam_%28cropped%29.jpg" id="bg" alt="">
    <div class="card border-info mb-4">
        <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/5/5b/Michelangelo_-_Creation_of_Adam_%28cropped%29.jpg" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">DCConsultas</h2>
            <p class="card-text">Proyecto realizado por José Baboun y Matías Cadile, IIC2413.</p>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                </ul>
            </div>
        </nav>
    </div>

<!--Consulta1!-->
    <div class="card text-center border-info mb-3">
        <div class="card-header">
            Consulta 1
        </div>
        <div class="card-body">
            <h5 class="card-title">Artistas</h5>
            <p class="card-text">A continuación se muestran todos los nombres 
            distintos de los artistas.</p>
            <form align="center" action="consultas_e3/lista_artistas.php" method="post">
                <input type="submit" class="btn btn-primary" value="Consultar">
            </form>
        </div>
        <div class="card-footer text-muted">
            Actualizado: 21/4/2020
        </div>
    </div>
<!--Consulta2!-->
    <div class="card text-center border-info mb-3">
        <div class="card-header">
            Consulta 2
        </div>
        <div class="card-body">
            <h5 class="card-title">Plazas con esculturas de Gian Lorenzo Bernini</h5>
            <p class="card-text">A continuación se muestran todas las plazas con al menos 
            una escultura de Gian Lorenzo Bernini.</p>
            <form align="center" action="consultas_e3/playground.php" method="post">
                <input type="submit" class="btn btn-primary" value="Consultar">
            </form>
        </div>
        <div class="card-footer text-muted">
            Actualizado: 21/4/2020
        </div>
    </div>
<!--Consulta3!-->
    <div class="card text-center border-info mb-3">
        <div class="card-header">
            Buscador
        </div>
        <div class="card-body">
            <p class="card-text">A continuación puede usar esta casilla para buscar.</p>
            <p class="card-text">Por favor ingrese el nombre de un país:</p>
            <form align="center" action="consultas_e3/consulta3.php" method="post">
                <input type="text" class="form-control text-center form-rounded" name="pais" target="_blank">
                <br></br>
                <input type="submit" class="btn btn-primary" value="Consultar">
            </form>
        </div>
        <div class="card-footer text-muted">
            Actualizado: 21/4/2020
        </div>
    </div>
<!--Consulta4!-->
    <div class="card text-center border-info mb-3">
            <div class="card-header">
                Consulta 4
            </div>
            <div class="card-body">
                <h5 class="card-title">Artistas y sus participaciones</h5>
                <p class="card-text">A continuación se muestra el nombre 
                y cantidad de participaciones en obras de cada artista.</p>
                <form align="center" action="consultas_e3/consulta4.php" method="post">
                    <input type="submit" class="btn btn-primary" value="Consultar">
                </form>
            </div>
            <div class="card-footer text-muted">
                Actualizado: 21/4/2020
            </div>
        </div>
<!--Consulta5!-->
    <div class="card text-center border-info mb-3">
            <div class="card-header">
                Consulta 5
            </div>
            <div class="card-body">
                <h5 class="card-title">Iglesias y frescos</h5>
                <p class="card-text">A continuación se muestran las iglesias junto a los frescos disponibles
                en cada una de ellas, según un horario de apertura, de cierre, y una ciudad.</p>
                <form align="center" action="consultas_e3/consulta5.php" method="post">                
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p>Ingrese un horario de apertura (formato hh:mm:ss):</p>
                            <input type="text" class="form-control form-rounded" name="h_apertura">
                        </li>
                        <li class="list-group-item">
                            <p>Ingrese un horario de cierre (formato hh:mm:ss):</p>
                            <input type="text" class="form-control form-rounded" name="h_cierre">
                        </li>
                        <li class="list-group-item">
                            <p>Ingrese una ciudad:</p>
                            <input type="text" class="form-control form-rounded" name="ciudad">
                        </li>
                    </ul>
                    <input type="submit" class="btn btn-primary" value="Consultar">
                </form>
            </div>
            <div class="card-footer text-muted">
                Actualizado: 21/4/2020
            </div>
    </div>
<!--Consulta6!-->
    <div class="card text-center border-info mb-3">
            <div class="card-header">
                Consulta 6
            </div>
            <div class="card-body">
                <h5 class="card-title">Lugares con obras de todo período</h5>
                <p class="card-text">A continuación se muestran museos, plazas e iglesias 
                que contengan obras de todo período del arte.</p>
                <form align="center" action="consultas_e3/consulta6.php" method="post">
                    <input type="submit" class="btn btn-primary" value="Consultar">
                </form>
            </div>
            <div class="card-footer text-muted">
                Actualizado: 21/4/2020
            </div>
        </div>