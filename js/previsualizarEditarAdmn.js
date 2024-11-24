
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    
    const id = urlParams.get('id');
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'previstaEditarProductos.php?id=' + id, true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('container_edit').innerHTML = this.responseText;
        }
    };
    xhr.send();
});
