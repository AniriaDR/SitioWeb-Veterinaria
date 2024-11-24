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
$categoria = isset($_GET['categoria']) ? mysqli_real_escape_string($enlace, $_GET['categoria']) : '';

$consulta = "SELECT * FROM productos WHERE categoria = '$categoria'";
$ejecutarConsulta = mysqli_query($enlace, $consulta);

if(!$ejecutarConsulta){
    echo"Error en la consulta del carrito";
}else{
    while($recuperar = mysqli_fetch_array($ejecutarConsulta)){

        echo'
        <div class= "product" style="text-align: center;color: #d99595;">
        <img src="'.$recuperar['imagen'].'" alt="'.$recuperar['nombreProducto'].'">
        <h2>'.$recuperar['nombreProducto'].'</h2>
        <p>'.$recuperar['detalles'].'</p>
        <button class="add-button" style="border: 2px solid #d99595; color: #d99595;" onclick="borrar('.$recuperar['IDProducto'].')">Eliminar</button>
        <button class="add-button" onclick="visitarEditar('.$recuperar['IDProducto'].')">Editar</button>
        </div>';
    }
}
?>