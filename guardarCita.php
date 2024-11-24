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

$nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
$apellido = mysqli_real_escape_string($enlace, $_POST['apellido']);
$mascota = mysqli_real_escape_string($enlace, $_POST['mascota']);
$telefono = intval($_POST['telefono']);
$razonCita = mysqli_real_escape_string($enlace, $_POST['razonCita']);
$fecha = mysqli_real_escape_string($enlace, $_POST['fecha']);
$hora = mysqli_real_escape_string($enlace, $_POST['hora']);

$consultaVerificar = "SELECT IDCliente FROM cliente WHERE nombreCliente='$nombre' AND apellido='$apellido' AND telefono='$telefono'";
$resultadoVerificar = mysqli_query($enlace, $consultaVerificar);


if (mysqli_num_rows($resultadoVerificar) > 0) {

    $fila = mysqli_fetch_assoc($resultadoVerificar);
    $idCliente = $fila['IDCliente'];

} else {

    $consulta1 = "INSERT INTO cliente (nombreCliente, apellido, telefono) 
                 VALUES ('$nombre', '$apellido', '$telefono')";
    $ejecutarConsulta1 = mysqli_query($enlace, $consulta1);
    
    if (!$ejecutarConsulta1) {
        echo "<script>
            alert('Error al registrar el cliente.');
            window.location.href = 'formCitas.html';
        </script>";
        exit;
    }
    $idCliente = mysqli_insert_id($enlace);
}

$consulta2 = "INSERT INTO citas (IDCliente, mascota, razonCita, fecha, hora) 
VALUES ('$idCliente', '$mascota', '$razonCita', '$fecha', '$hora')";
$ejecutarConsulta2 = mysqli_query($enlace, $consulta2);

$nom = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');

if (!$ejecutarConsulta2) {
    echo "<script>
        alert('Lo sentimos, error al registrar la cita.');
        window.location.href = 'formCitas.html';
    </script>";
} else {
    echo "<script>
        alert('¡Gracias $nom! La cita se registró con éxito');
        window.location.href = 'formCitas.html';
    </script>";
}
mysqli_close($enlace);
?>