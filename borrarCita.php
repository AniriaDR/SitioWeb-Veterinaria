<?php
$servidor="localhost";      
$usuario="root";
$clave="";
$baseDeDatos="user";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if(!$enlace){
    echo"Error en la conexion con el servidor";
    exit;
}
$id = $_GET['id'];
$consulta = "DELETE FROM citas WHERE IDCita = '$id'";
$ejecutarConsulta = mysqli_query($enlace, $consulta);

if (!$ejecutarConsulta) {
    echo "Error al eliminar la cita";
} else {
    echo "La cita se eliminó con éxito";
}
mysqli_close($enlace);
?>