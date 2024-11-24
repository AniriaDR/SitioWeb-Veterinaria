<?php
$servidor = "localhost";      
$usuario = "root";
$clave = "";
$baseDeDatos = "user";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
    exit;
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$nombreCliente = isset($_POST['nombreCliente']) ? mysqli_real_escape_string($enlace, $_POST['nombreCliente']) : '';
$apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($enlace, $_POST['apellido']) : '';
$mascota = isset($_POST['mascota']) ? mysqli_real_escape_string($enlace, $_POST['mascota']) : '';
$telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($enlace, $_POST['telefono']) : '';
$razonCita = isset($_POST['razonCita']) ? mysqli_real_escape_string($enlace, $_POST['razonCita']) : '';
$fecha = isset($_POST['fecha']) ? mysqli_real_escape_string($enlace, $_POST['fecha']) : '';
$hora = isset($_POST['hora']) ? mysqli_real_escape_string($enlace, $_POST['hora']) : '';


$consulta = "UPDATE citas 
                 INNER JOIN cliente ON cliente.IDCliente = citas.IDCliente
                 SET 
                     citas.mascota = '$mascota',
                     citas.razonCita = '$razonCita',
                     citas.fecha = '$fecha',
                     citas.hora = '$hora',
                     cliente.nombreCliente = '$nombreCliente',
                     cliente.apellido = '$apellido',
                     cliente.telefono = '$telefono'
                 WHERE citas.IDCita = $id";

$ejecutarConsulta = mysqli_query($enlace, $consulta);

if (!$ejecutarConsulta) {
    echo "<script>
        alert('Error al actualizar la cita');
        window.location.href = 'citasEditarAdmin.html';
    </script>";
} else {
    echo "<script>
        alert('La cita se actualizó con éxito');
        window.location.href = 'citasEditarAdmin.html';
    </script>";
}

mysqli_close($enlace);
?>

