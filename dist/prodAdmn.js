const defaultProducts = {
    alimentos: [
        {
            img: "/img/gatoComida.png",
            title: "Croquetas para gato.",
            description: "Te ofrecemos una variedad de alimentos de alta calidad para gatos."
        },
        {
            img: "/img/perroComida.png",
            title: "Alimento premium para perro.",
            description: "Alimentos con ingredientes naturales que apoyan la salud de tu perro."
        },
        {
            img: "/img/gatoHumeda.png",
            title: "Comida húmeda para gatos.",
            description: "Un festín jugoso y delicioso para el paladar de tu felino."
        }
    ],
    farmacia: [
        {
            img: "/img/pulgaGato.png",
            title: "Antipulgas para gatos.",
            description: "Protege a tu gato de pulgas con este tratamiento eficaz."
        },
        {
            img: "/img/vitPerro.png",
            title: "Vitaminas para perros.",
            description: "Suplemento vitamínico ideal para perros de todas las razas."
        },
        {
            img: "/img/inflaPerro.png",
            title: "Antiinflamatorios para mascotas.",
            description: "Ayuda a reducir la inflamación en tu mascota tras cirugías."
        }
    ],
    accesorios: [
        {
            img: "/img/correa.png",
            title: "Correa para perros.",
            description: "Una correa resistente y cómoda para pasear a tu perro."
        },
        {
            img: "/img/intGato.png",
            title: "Juguete interactivo para gatos.",
            description: "Mantén a tu gato activo y entretenido con este juguete."
        },
        {
            img: "/img/CamaMasc.png",
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

function loadProducts(category) {
    const products = productos[category];
    carouselContainer.innerHTML = '';  // Limpiar contenido actual

    products.forEach(product => {
        const productDiv = document.createElement("div");
        productDiv.classList.add("product");

        productDiv.innerHTML = `
            <img src="${product.img}" alt="${product.title}">
            <h2>${product.title}</h2>
            <p>${product.description}</p>
        `;

        carouselContainer.appendChild(productDiv);
    });
}

// Cambiar de pestaña y productos
tabButtons.forEach(button => {
    button.addEventListener("click", () => {
        document.querySelector(".tab-btn.active").classList.remove("active");
        button.classList.add("active");
        loadProducts(button.dataset.category);
    });
});

// Cargar productos iniciales (Alimentos)
loadProducts('alimentos');
