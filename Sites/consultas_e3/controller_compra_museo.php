<?php
# eid - uid - lid - fechacompra
session_start()

$fecha_actual = date("Y-m-d", time());

$lid = $_POST["lid"];
$lid = number_format($lid);

# Aca saco el uid
$username = $_SESSION['user'];
$query_uid = "SELECT uid FROM Usuarios WHERE Usuarios.username = '$username';";
$resultado = $db_19 -> prepare($query_uid);
$resultado -> execute();
$uid_usuario = $resultado -> fetchAll();
foreach ($uid_usuario as $u){
    $uid = number_format(intval($u[0]));

# Numero de Entrada
$query_max = "SELECT MAX(eid) FROM Entradas;";
$resultado = $db_19 -> prepare($query_max);
$resultado -> execute();
$numero_max = $resultado -> fetchAll();
foreach ($numero_max as $r){
    $eid = number_format(intval($r[0]) + 1);

$query = "INSERT INTO Entradas VALUES('$eid', '$uid', '$lid', '$fecha_actual');";
$agregar = $db_19 -> prepare($query);
$agregar -> execute();
$resultado = $agregar -> fetchAll();

echo 
  "<div id='myModal' class='modal fade'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title'>¡Compra exitosa!</h4>
                </div>
                <div class='modal-body'>
                    <p>Haz click aquí para ver todos tus tickets:</p>
                    <form action='../users/mi_perfil.php' method='get'>
                      <input type='submit' class='btn btn-primary mt-8 mb-5' value='Mi perfil'>
                    </form>
                    <form action='../index.php' method='get'>
                      <input type='submit' class='btn btn-primary mt-8 mb-5' value='Volver al menú'>
                    </form>
                </div>
            </div>
        </div>
    </div>";
?>