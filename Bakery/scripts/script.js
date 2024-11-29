//carrito de compras---------------------------------------------------------------------------
let carrito = JSON.parse(localStorage.getItem('agregar-carrito')) || []; // Cargar el carrito desde localStorage
let total = calcularTotal(); // Inicializa el total

document.addEventListener('DOMContentLoaded', () => {
    const cartContainer = document.getElementById('cart-items');
    const totalCarrito = document.getElementById('total-carrito');

    if (cartContainer && totalCarrito) {
        actualizarCarrito(); // Actualizar carrito desde el almacenamiento al cargar la página
    } else {
    /*console.error('Elementos no encontrados en el DOM:', {
            cartContainer: cartContainer,
            totalCarrito: totalCarrito
        });*/
    }
});

function calcularTotal() {
    return carrito.reduce((acc, producto) => acc + producto.subtotal, 0);
}

function cambiarCantidad(elemento, cambio) {
    let input = elemento.parentNode.querySelector('.cantidad');
    let valorActual = parseInt(input.value);
    let nuevoValor = valorActual + cambio;

    if (nuevoValor >= 1 && nuevoValor <= 5) {
        input.value = nuevoValor;
        let nombreProducto = elemento.closest('.cart-items').querySelector('.product-info h2').innerText;
        let productoEnCarrito = carrito.find(producto => producto.nombre === nombreProducto);

        if (productoEnCarrito) {
            productoEnCarrito.cantidad = nuevoValor;
            productoEnCarrito.subtotal = productoEnCarrito.cantidad * productoEnCarrito.precio;
            localStorage.setItem('agregar-carrito', JSON.stringify(carrito));
            actualizarCarrito();
        }
    } else {
        alert("La cantidad debe estar entre 1 y 5.");
    }
}

function agregarAlCarrito(nombreProducto, precioProducto, idProducto, imagenProducto) {
    let cantidadInput = document.querySelector(`#cantidad-${idProducto}`);
    let cantidad = cantidadInput ? parseInt(cantidadInput.value) : 1;

    if (!cantidad || cantidad <= 0) {
        alert("Por favor, ingrese una cantidad válida.");
        return;
    }

    let productoExistente = carrito.find(producto => producto.nombre === nombreProducto);

    if (productoExistente) {
        // Si el producto ya existe, solo aumenta la cantidad y actualiza el subtotal
        productoExistente.cantidad += cantidad;
        productoExistente.subtotal = productoExistente.cantidad * precioProducto;
    } else {
        // Si el producto no existe, se agrega como nuevo
        let producto = {
            id: idProducto,
            nombre: nombreProducto,
            cantidad: cantidad,
            precio: precioProducto,
            subtotal: cantidad * precioProducto,
            imagen: imagenProducto
        };
        carrito.push(producto);
        console.log("Producto agregado al carrito:", producto);
        alert(`"${nombreProducto}" ha sido agregado al carrito.`);
    }

    localStorage.setItem('agregar-carrito', JSON.stringify(carrito));
    actualizarCarrito();

    alert(`"${nombreProducto}" ha sido agregado al carrito.`);
}

//borrar carrrito fium fium
function eliminarDelCarrito(nombreProducto) {
    carrito = carrito.filter(producto => producto.nombre !== nombreProducto); // Eliminar el producto del arreglo
    localStorage.setItem('agregar-carrito', JSON.stringify(carrito)); // Actualizar localStorage
    actualizarCarrito(); // Refrescar la interfaz del carrito

    alert(`"${nombreProducto}" ha sido eliminado del carrito.`);
}
//actualiza fium fium

function actualizarCarrito() {
    let listaCarrito = document.getElementById('cart-items');
    let totalCarrito = document.getElementById('total-carrito');

    // Solo proceder si los elementos existen en el DOM
    if (!listaCarrito || !totalCarrito) {
        /*console.error("Elementos 'cart-items' o 'total-carrito' no encontrados en el DOM.");
        return;*/
    }
    listaCarrito.innerHTML = '';

    carrito.forEach(producto => {
        let item = document.createElement('div');
        item.classList.add('cart-items');
        item.innerHTML = `
            <img src="${producto.imagen}" alt="${producto.nombre}" class="product-image">
            <div class="product-info">
                <h2>${producto.nombre}</h2>
                <p>Precio: $${producto.precio.toFixed(2)}</p>
            </div>
            </div>
            <div class="quantity">
                <button class="cantidad-btn" onclick="cambiarCantidad(this, -1)">-</button>
                <input type="text" class="cantidad" value="${producto.cantidad}" min="1" max="5">
                <button class="cantidad-btn" onclick="cambiarCantidad(this, 1)">+</button>
                <button class="delete-btn" onclick="eliminarDelCarrito('${producto.nombre}')">🗑️</button>
                </div>
            <div class="item-total"> $${producto.subtotal.toFixed(2)}</div>
        </div>
        `;
        listaCarrito.appendChild(item);
    });

    total = calcularTotal();
    totalCarrito.textContent = `$${total.toFixed(2)}`;
}
///////////////////////////////////////////////////////////////////////////

