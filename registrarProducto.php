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

$nombreProducto = mysqli_real_escape_string($enlace, $_POST['nombreProducto']);
$detalles = mysqli_real_escape_string($enlace, $_POST['detalles']);
$categoria = mysqli_real_escape_string($enlace, $_POST['categoria']);
$n_archivo = $_FILES['imagen']['name'];
$archivo = $_FILES['imagen']['tmp_name'];

$linkImagen = "img/".$n_archivo;

move_uploaded_file($archivo,$linkImagen);


$consulta = "INSERT INTO productos (nombreProducto,detalles,categoria, imagen)
VALUES ('$nombreProducto', '$detalles','$categoria','$linkImagen')";
$ejecutarConsulta = mysqli_query($enlace, $consulta);

if (!$ejecutarConsulta) {
    echo "<script>
        alert('Error en registrar producto');
        window.location.href = 'formProd.html';
    </script>";
} else {
    echo "<script>
        alert('El producto se registró con éxito');
        window.location.href = 'formProd.html';
    </script>";
}
mysqli_close($enlace);
?>