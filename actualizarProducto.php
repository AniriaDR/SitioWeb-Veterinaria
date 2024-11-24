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
$nombreProducto = isset($_POST['nombreProducto']) ? mysqli_real_escape_string($enlace, $_POST['nombreProducto']) : '';
$detalles = isset($_POST['detalles']) ? mysqli_real_escape_string($enlace, $_POST['detalles']) : '';
$categoria = isset($_POST['categoria']) ? mysqli_real_escape_string($enlace, $_POST['categoria']) : '';

if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name']) {
    $n_archivo = $_FILES['imagen']['name'];
    $archivo = $_FILES['imagen']['tmp_name'];
    $linkImagen = "img/" . $n_archivo;

    move_uploaded_file($archivo, $linkImagen);

    $consulta = "UPDATE productos SET 
        nombreProducto = '$nombreProducto',
        detalles = '$detalles',
        categoria = '$categoria',
        imagen = '$linkImagen' 
        WHERE IDProducto = '$id'";
} else {
    $consulta = "UPDATE productos SET 
        nombreProducto = '$nombreProducto',
        detalles = '$detalles',
        categoria = '$categoria'
        WHERE IDProducto = '$id'";
}

$ejecutarConsulta = mysqli_query($enlace, $consulta);

if (!$ejecutarConsulta) {
    echo "<script>
        alert('Error al actualizar el producto');
        window.location.href = 'ProductosAdmn.html';
    </script>";
} else {
    echo "<script>
        alert('El producto se actualizó con éxito');
        window.location.href = 'ProductosAdmn.html';
    </script>";
}

mysqli_close($enlace);
?>

