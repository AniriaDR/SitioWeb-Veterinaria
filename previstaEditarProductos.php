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
$consulta = "SELECT * FROM productos WHERE IDProducto = '$id'";
$ejecutarConsulta = mysqli_query($enlace, $consulta);

if(!$ejecutarConsulta){
    echo"Error en mostrar productos";
}else{
    
    $recuperar = mysqli_fetch_array($ejecutarConsulta);

    echo"<label for='nombre'>Nombre</label>
            <input type='text' id='nombre' name='nombreProducto' 
            value='".$recuperar['nombreProducto']."'>

            <label for='detalles'>Detalles</label>
            <textarea id='detalles' name='detalles' placeholder='Detalles del producto'>
            ".$recuperar['detalles']."</textarea>

            <label for='categoria'>Categoría</label>
            <select name='categoria' id='categoria'>
                <option value='alimentos' ".($recuperar['categoria'] == 'alimentos' ? 'selected' : '').">Alimentos</option>
                <option value='farmacia' ".($recuperar['categoria'] == 'farmacia' ? 'selected' : '').">Farmacia</option>
                <option value='accesorios' ".($recuperar['categoria'] == 'accesorios' ? 'selected' : '').">Accesorios</option>
            </select>

            <label for='imagen'>Imagen actual</label>
            <img src='".$recuperar['imagen']."'; alt='Imagen actual' style='max-width: 150px; max-height: 150px; display: block; margin-bottom: 10px; text-aling:center'>

            <label for='imagen'>Imagen</label>
            <div id='drop-area'>
                <p>Arrastra y suelta una imagen aquí o haz clic para seleccionar una</p>
                <input type='file' id='imagen' name='imagen'  accept='image/*' onchange='handleFileSelect(event)' 
                 >
            </div><br>
            <input type='hidden' name='id' value='". $recuperar['IDProducto'] ."'>
            <button class='add-button' type='submit' style='width: 100%;'>Actualizar</button>";
    
}

?>