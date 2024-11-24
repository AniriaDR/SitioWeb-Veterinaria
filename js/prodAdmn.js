document.addEventListener("DOMContentLoaded", function () {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'mostrarProductosAdmin.php?categoria=' + 'Alimentos', true);
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
    xhr.open('GET', 'mostrarProductosAdmin.php?categoria=' + categoria, true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('carousel-container').innerHTML = this.responseText;
        }
    };
    xhr.send();

    document.querySelector(".tab-btn.active").classList.remove("active");
    button.classList.add("active");
}
