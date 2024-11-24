
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    
    const id = urlParams.get('id');
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'previstaEditarCitas.php?id=' + id, true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('form-container').innerHTML = this.responseText;
        }
    };
    xhr.send();
});
