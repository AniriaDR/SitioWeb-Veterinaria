
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'visualizarCitasAdmin.php', true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('appointment-list').innerHTML = this.responseText;
        }
    };
    xhr.send();
});
