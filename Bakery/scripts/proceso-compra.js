const deliveryRadios = document.querySelectorAll('input[name="deliveryType"]');
const paymentRadios = document.querySelectorAll('input[name="paymentType"]');
const submitButton = document.querySelector('button[type="submit"]');
const paymentWarning = document.getElementById('paymentWarning');

// Función para gestionar las opciones de pago y mostrar el mensaje
function handlePaymentOptions() {
    const isDomicilio = document.querySelector('input[name="deliveryType"]:checked') !== null && document.querySelector('input[name="deliveryType"]:checked').value === 'domicilio';

    // Si el tipo de envío es "domicilio"
    if (isDomicilio) {
        // Deshabilitar el pago en efectivo
        paymentRadios.forEach(radio => {
            if (radio.value === 'sucursal') {
                radio.disabled = true; // Deshabilitar el pago en efectivo
            }
        });

        // Mostrar el mensaje de advertencia
        paymentWarning.classList.remove('hidden');
        // Seleccionar automáticamente el pago electrónico
        document.querySelector('input[name="paymentType"][value="electronic"]').checked = true;
    } else {
        // Habilitar el pago en efectivo si el tipo de envío no es "domicilio"
        paymentRadios.forEach(radio => {
            if (radio.value === 'sucursal') {
                radio.disabled = false;
            }
        });

        // Ocultar el mensaje de advertencia
        paymentWarning.classList.add('hidden');
    }
}

// Mostrar opciones de pago cuando se selecciona un tipo de envío
deliveryRadios.forEach(radio => {
    radio.addEventListener('change', () => {
        handlePaymentOptions(); // Llamar a la función que gestiona las opciones de pago
        submitButton.classList.remove('hidden'); // Habilitar el botón de envío
    });
});

// Acción al enviar el formulario
document.getElementById('orderForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const deliveryType = document.querySelector('input[name="deliveryType"]:checked').value;
    const paymentType = document.querySelector('input[name="paymentType"]:checked').value;

    // Obtener los productos del carrito desde localStorage
    const cart = JSON.parse(localStorage.getItem('agregar-carrito')) || [];

    // Crear los datos a enviar
    const formData = new FormData();
    formData.append('deliveryType', deliveryType);
    formData.append('paymentType', paymentType);
    formData.append('agregar-carrito', JSON.stringify(cart));

    // Si el tipo de envío es "domicilio"
    if (deliveryType === 'domicilio') {
        // Redirigir a la página de formulario de domicilio con el tipo de pago electrónico
        window.location.href = '../Bakery/form_domicilio.php?paymentType=electronic';
    } else {
        // Si el tipo de envío es "sucursal"
        if (paymentType === 'electronic') {
            // Si el pago es electrónico, redirigir al formulario de pago
            window.location.href = '../Bakery/form_pago.php';
        } else {
            // Si el pago es en sucursal, guardar la compra en la base de datos y redirigir
            fetch('functions/save_compra.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log('Respuesta de save_compra:', data);

                // Suponemos que save_compra.php devuelve el ID de la compra como respuesta
                if (data && !isNaN(data)) {
                    const purchaseId = parseInt(data, 10); // Convertir a número
                    // Redirigir a ticket01.php con el ID de la compra
                    window.location.href = `functions/ticket01.php?purchase_id=${purchaseId}`;
                } else {
                    console.error('Error: ID de compra no válido devuelto:', data);
                    alert('Hubo un problema al procesar la compra. Por favor, inténtalo de nuevo.');
                }
            })
            .catch(error => {
                console.error('Error al enviar datos a save_compra:', error);
                alert('Hubo un error al procesar tu compra. Revisa tu conexión o contacta al soporte.');
            });
        }
    }
});

// Inicialización al cargar la página para verificar si ya está seleccionada una opción de tipo de envío
handlePaymentOptions();
