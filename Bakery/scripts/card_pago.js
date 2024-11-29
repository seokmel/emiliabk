document.getElementById('payment-form').addEventListener('submit', function(event) {
    let isValid = true;

    // Validación del nombre
    if (document.getElementById('name').value.trim() === '') {
        alert('Por favor, ingrese su nombre.');
        isValid = false;
    }

    // Validación del número de tarjeta
    const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
    if (!/^\d{16}$/.test(cardNumber)) {
        alert('El número de tarjeta debe tener 16 dígitos.');
        isValid = false;
    }

    // Validación de la fecha de expiración
    const expirationDate = document.getElementById('expirationDate').value;
    if (!/^\d{2}\/\d{2}$/.test(expirationDate)) {
        alert('La fecha de expiración debe estar en el formato MM/AA.');
        isValid = false;
    }

    // Validación del CVV
    const cvv = document.getElementById('cvv').value;
    if (!/^\d{3}$/.test(cvv)) {
        alert('El CVV debe tener 3 dígitos.');
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault(); // Previene que el formulario se envíe
    }
});

