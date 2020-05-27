<?php session_start(); ?>

<?php
# eid - uid - lid - fechacompra
require("../config/conexion.php");
$fecha_actual = date("Y-m-d", time());

$lid = $_POST["lid"];
$lid = number_format($lid);

# Aca saco el uid
$username = $_SESSION['user'];
$query_uid = "SELECT Usuarios.uid FROM Usuarios WHERE Usuarios.username = '$username';";
$resultado = $db_19 -> prepare($query_uid);
$resultado -> execute();
$uid_usuario = $resultado -> fetchAll();
foreach ($uid_usuario as $u){
    $uid = number_format(intval($u[0]));
}
# Numero de Entrada
$query_max = "SELECT MAX(eid) FROM Entradas;";
$resultado = $db_19 -> prepare($query_max);
$resultado -> execute();
$numero_max = $resultado -> fetchAll();
foreach ($numero_max as $r){
    $eid = number_format(intval($r[0]) + 1);
}
$query = "INSERT INTO Entradas VALUES('$eid', '$uid', '$lid', '$fecha_actual');";
$agregar = $db_19 -> prepare($query);
$agregar -> execute();
$resultado = $agregar -> fetchAll();

header('Status: 301 Moved Permanently', false, 301);
header('Location: ../index.php');
exit();
?>