const defaultProducts = {
    alimentos: [
        {
            img: "img/gatoComida.jpg",
            title: "Croquetas para gato.",
            description: "Te ofrecemos una variedad de alimentos de alta calidad para gatos."
        },
        {
            img: "img/perroComida.jpg",
            title: "Alimento premium para perro.",
            description: "Alimentos con ingredientes naturales que apoyan la salud de tu perro."
        },
        {
            img: "img/gatoHumeda.jpg",
            title: "Comida húmeda para gatos.",
            description: "Un festín jugoso y delicioso para el paladar de tu felino."
        }
    ],
    farmacia: [
        {
            img: "img/pulgaGato.webp",
            title: "Antipulgas para gatos.",
            description: "Protege a tu gato de pulgas con este tratamiento eficaz."
        },
        {
            img: "img/vitPerro.jpg",
            title: "Vitaminas para perros.",
            description: "Suplemento vitamínico ideal para perros de todas las razas."
        },
        {
            img: "img/inflaPerro.png",
            title: "Antiinflamatorios para mascotas.",
            description: "Ayuda a reducir la inflamación en tu mascota tras cirugías."
        }
    ],
    accesorios: [
        {
            img: "img/correa.jpg",
            title: "Correa para perros.",
            description: "Una correa resistente y cómoda para pasear a tu perro."
        },
        {
            img: "img/intGato.webp",
            title: "Juguete interactivo para gatos.",
            description: "Mantén a tu gato activo y entretenido con este juguete."
        },
        {
            img: "img/CamaMasc.jpeg",
            title: "Cama para mascotas.",
            description: "Camas de alta calidad que brindan el máximo confort a tus mascotas."
        }
    ]
};

// Cargar productos desde localStorage o usar productos predeterminados
function loadProductsFromStorage() {
    const storedProducts = localStorage.getItem('productos');
    return storedProducts ? JSON.parse(storedProducts) : defaultProducts; // Si no hay productos, usa los predeterminados
}

let productos = loadProductsFromStorage(); // Cargar productos

const tabButtons = document.querySelectorAll(".tab-btn");
const carouselContainer = document.getElementById("carousel-container");

function saveProductsToStorage() {
    localStorage.setItem('productos', JSON.stringify(productos)); // Guardar productos en localStorage
}

function loadProductsForEdit(category) {
    const products = productos[category];
    carouselContainer.innerHTML = '';  // Limpiar contenido actual

    products.forEach((product, index) => {
        const productDiv = document.createElement("div");
        productDiv.classList.add("product");

        productDiv.innerHTML = `
            <img src="${product.img}" alt="${product.title}">
            <h2>${product.title}</h2>
            <p>${product.description}</p>
            <button class="delete-button" data-index="${index}" data-category="${category}">Eliminar</button>
        `;

        carouselContainer.appendChild(productDiv);
    });

    // Añadir eventos de eliminación
    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", (e) => {
            const index = e.target.dataset.index;
            const category = e.target.dataset.category;

            // Eliminar el producto
            productos[category].splice(index, 1);
            saveProductsToStorage(); // Guardar cambios
            loadProductsForEdit(category); // Volver a cargar productos
        });
    });
}

// Cambiar de pestaña y cargar productos
tabButtons.forEach(button => {
    button.addEventListener("click", () => {
        document.querySelector(".tab-btn.active").classList.remove("active");
        button.classList.add("active");
        loadProductsForEdit(button.dataset.category);
    });
});

// Agregar nuevo producto
document.querySelector(".add-button").addEventListener("click", () => {
    const category = document.querySelector(".tab-btn.active").dataset.category;

    const newProduct = {
        img: prompt("Ingresa la URL de la imagen:"),
        title: prompt("Ingresa el nombre del producto:"),
        description: prompt("Ingresa una descripción del producto:")
    };

    // Validar si se completaron todos los campos
    if (newProduct.img && newProduct.title && newProduct.description) {
        productos[category].push(newProduct);
        saveProductsToStorage(); // Guardar cambios
        loadProductsForEdit(category); // Volver a cargar productos
    } else {
        alert("Todos los campos son obligatorios.");
    }
});

// Confirmar cambios y volver a la página principal
document.querySelector(".confirm-button").addEventListener("click", () => {
    alert("Los cambios han sido guardados.");
    window.location.href = "ProductosAdmn.html"; // Redirigir a la página principal
});

// Cargar productos iniciales (Alimentos)
loadProductsForEdit('alimentos');
