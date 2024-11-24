
function borrar(id) {
    var resultado = window.confirm('¿Estás seguro que deseas borrar la cita?');
    if (resultado === true) {

        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'borrarCita.php?id=' + id, true);
        xhr.onload = function () {
            if (this.status === 200) {
                alert(this.responseText);
                location.href = 'MisCitas.html';
            }
        };
        xhr.send();
    }
}

function visitarEditar(id) {
    location.href = `editCita.html?id=${encodeURIComponent(id)}`;
}








