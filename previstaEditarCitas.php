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
$consulta = "SELECT citas.IDCita, citas.mascota, citas.razonCita, citas.fecha, citas.hora,
    cliente.IDCliente, cliente.nombreCliente, cliente.apellido, cliente.telefono 
    FROM citas
    INNER JOIN cliente ON cliente.IDCliente = citas.IDCliente WHERE IDCita = '$id'";

$ejecutarConsulta = mysqli_query($enlace, $consulta);

if(!$ejecutarConsulta){
    echo"Error en mostrar la cita";
}else{
    
    $recuperar = mysqli_fetch_array($ejecutarConsulta);

            echo"<div class='input-group'>
                    <label for='nombre'>Nombre</label>
                    <input type='text' name='nombreCliente' value='".$recuperar['nombreCliente']."' required><br>
                    <label for='apellido'>Apellido</label>
                    <input type='text' name='apellido' value='".$recuperar['apellido']."' required><br>
                </div>
                <div class='input-group'>
                    <label for='mascota'>Mascota</label> <br>
                    <input type='text' name='mascota'  value='".$recuperar['mascota']."'required><br>
                    <label for='tel'>Número teléfonico</label><br>
                    <input type='tel' name='telefono' pattern='^\d{10}$' minlength='10' maxlength='10' 
                    oninput='this.value = this.value.replace(/\s+/g, '')' value='".$recuperar['telefono']."' required><br>
                </div>
                <div class='input-group'>
                    <label for='motivo'>Motivo de la cita</label><br>
                    <select name='razonCita' required>
                        <option disabled selected>Selecciona uno</option>
                        <option value='Consulta' ".($recuperar['razonCita'] == 'Consulta' ? 'selected' : '')." >Consulta</option>
                        <option value='Vacunación' ".($recuperar['razonCita'] == 'Vacunación' ? 'selected' : '')." >Vacunación</option>
                        <option value='Desparasitación' ".($recuperar['razonCita'] == 'Desparasitación' ? 'selected' : '').">Desparasitación</option>
                    </select>
                    <label for='fecha'>Fecha</label><br><br>
                    <input type='date' name='fecha' value='".$recuperar['fecha']."' required>
                </div>
                <div class='input-group'>
                    <label for='hora'>Hora</label><br><br>
                    <select name='hora' required>
                        <option disabled selected>Selecciona uno</option>
                        <option value='09:00:00' ".($recuperar['hora'] == '09:00:00' ? 'selected' : '').">09:00 AM</option>
                        <option value='10:00:00' ".($recuperar['hora'] == '10:00:00' ? 'selected' : '').">10:00 AM</option>
                        <option value='11:00:00' ".($recuperar['hora'] == '11:00:00' ? 'selected' : '').">11:00 AM</option>
                    </select>
                    <input type='hidden' name='id' value='". $recuperar['IDCita'] ."'>
                </div>";
    
}

?>