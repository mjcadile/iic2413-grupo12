<?php
session_start();
?>
<?php include('../templates/header_sin_searchbox.html');   ?>

<body>

<img src="https://cdn.pixabay.com/photo/2014/11/02/10/41/aircraft-513641_1280.jpg" id="bg" alt="">
    <div class="card border-info mb-4">
        <img class="card-img-top" src="https://cdn.pixabay.com/photo/2014/11/02/10/41/aircraft-513641_1280.jpg" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">Registrarse</h2>
        </div>
    </div>

    <div class="card text-center border-info mb-3">
        <div class='card-body'>
        <form align='center' action='registrarse.php' method='post'>
                    <p class="card-text"> Nombre </p>
                    <input type="text" name="nombre">
                    <p class="card-text"> Username </p>
                    <input type="text" name="username">
                    <p class='card-text'>  <?php if (!empty($_SESSION['user'])){
                        if ($_SESSION['user'] == "error username"){
                            echo "Username se encuentra ocupado, intente con otro.";
                        }
                    }?> </p>
                    <p class="card-text"> Correo </p>
                    <input type="text" name="correo">
                    <p class="card-text"> Dirección </p>
                    <input type="text" name="direccion">
                    <p class="card-text"> Contraseña </p>
                    <input type="password" name="contrasena">
                    <p class="card-text"> Repita la contraseña </p>
                    <input type="password" name="contrasena_confirm">
                    <p class="card-text">  </p>
                    <p class='card-text'>  <?php if (! empty($_SESSION['user'])){
                        if ($_SESSION['user'] == "error contraseña"){
                            echo "Las contraseñas no coinciden, intente denuevo.";
                        }
                    }?> </p>
                    <input type='submit' class='btn btn-primary mt-2 mb-2' value='Registrarse' />
                    
        </form>
        </div>
    </div>
</div>
<form action="../index.php" method="get">
    <input type="submit" class="btn btn-primary mt-8 mb-5" value="Menú Principal">
</form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="../js/actions.js"></script>
<script src="js/actions.js"></script>

</body>

</html>