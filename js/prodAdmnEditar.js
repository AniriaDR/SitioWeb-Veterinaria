
document.addEventListener("DOMContentLoaded", function () {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'productosAdminEdit.php?categoria=' + 'Alimentos', true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('carousel-container').innerHTML = this.responseText;
        }
    };
    xhr.send();
});

function categoria(categoria, button) {
    const carouselContainer = document.getElementById('carousel-container');
    carouselContainer.innerHTML = '';

    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'productosAdminEdit.php?categoria=' + categoria, true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('carousel-container').innerHTML = this.responseText;
        }
    };
    xhr.send();

    document.querySelector(".tab-btn.active").classList.remove("active");
    button.classList.add("active");
}

function borrar(id) {
    var resultado = window.confirm('¿Estás seguro que deseas borrar este producto?');
    if (resultado === true) {

        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'borrarProducto.php?id=' + id, true);
        xhr.onload = function () {
            if (this.status === 200) {
                alert(this.responseText);
                location.href = 'ProductosAdmn.html';
            }
        };
        xhr.send();
    }
}

function visitarEditar(id) {
    location.href = `editProd.html?id=${encodeURIComponent(id)}`;
}








