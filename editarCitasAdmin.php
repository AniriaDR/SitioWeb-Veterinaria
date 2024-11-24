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

$consulta = "SELECT citas.IDCita, citas.mascota, citas.razonCita, citas.fecha, citas.hora,
    cliente.IDCliente, cliente.nombreCliente, cliente.apellido, cliente.telefono 
    FROM citas
    INNER JOIN cliente ON cliente.IDCliente = citas.IDCliente";


$ejecutarConsulta = mysqli_query($enlace, $consulta);

if(!$ejecutarConsulta){
    echo"Error en mostrar las citas";
}else{
    $num = 0;
    while($recuperar = mysqli_fetch_array($ejecutarConsulta)){

        if(mysqli_num_rows($ejecutarConsulta) > 0){

            $num++;
            echo'<div class="appointment" style="border: 1px solid #ddd;text-align: center;">
                <h3 style="text-align: center;">Cita #'.$num.'</h3>
                <div style="width: 50%;float: left;text-align: left;">
                    <p><strong>Nombre:</strong> '.$recuperar['nombreCliente'].'</p>
                    <p><strong>Tipo de Mascota:</strong> '.$recuperar['mascota'].'</p>
                    <p><strong>Fecha:</strong> '.$recuperar['fecha'].'</p><br>
                </div>
                <div style="width: 50%;float: left;text-align: left;padding-left: 10%;">
                    <p><strong>Apellido:</strong> '.$recuperar['apellido'].'</p>
                    <p><strong>Razón de la cita:</strong> '.$recuperar['razonCita'].'</p>
                    <p><strong>Hora:</strong> '.$recuperar['hora'].' AM</p><br>
                </div>
                <button style="border: 2px solid #d99595; color: #d99595;  background-color: #f9f9f9;" onclick="borrar('.$recuperar['IDCita'].')">Borrar</button>
                <button style="margin-left:20px;" onclick="visitarEditar('.$recuperar['IDCita'].')">Editar</button><br>
            </div>';

        } else {
            echo "No hay citas registradas para este cliente.";
        }
    }
}
?>