// Selecciona el área de arrastre
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('imagen');

// Evita la carga predeterminada al arrastrar archivos
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false)
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Cambia el estilo al arrastrar archivos
['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.add('highlight'), false)
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.remove('highlight'), false)
});

// Maneja el evento de "drop" (cuando el usuario suelta el archivo)
dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    let dt = e.dataTransfer;
    let files = dt.files;
    handleFiles(files);
}

function handleFiles(files) {
    fileInput.files = files;
}

// Permite seleccionar la imagen al hacer clic en el área
dropArea.addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
    const file = event.target.files[0];
    fileInput.files = files;
    if (file) {
        dropArea.innerHTML = `<p>Imagen seleccionada: ${file.name}</p>`;
    }
}

