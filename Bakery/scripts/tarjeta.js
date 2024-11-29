document.getElementById('orderForm').addEventListener('submit', function(event) {
  event.preventDefault();

  // Obtener los productos del carrito desde localStorage
  const deliveryType = document.querySelector('input[name="deliveryType"]').value;
  const paymentType = document.querySelector('input[name="paymentType"]').value;
  const cart = JSON.parse(localStorage.getItem('agregar-carrito')) || [];

  // Crear los datos a enviar
  const formData = new FormData();
  formData.append('deliveryType', deliveryType);
  formData.append('paymentType', paymentType);
  formData.append('agregar-carrito', JSON.stringify(cart));

  // Validación de tarjeta antes de continuar
  const cardNumber = document.getElementById('card-number').value;
  const cardName = document.getElementById('card-name').value;
  const cardExpiry = document.getElementById('card-expiry').value;
  const cardCVV = document.getElementById('card-cvv').value;

  if (!validarFormulario()) {
      return; // Detiene el envío si la validación falla
  }

  // Agregar datos de tarjeta al formData
  formData.append('card-number', cardNumber);
  formData.append('card-name', cardName);
  formData.append('card-expiry', cardExpiry);
  formData.append('card-cvv', cardCVV);

  // Enviar los datos al servidor para procesar la compra
  fetch('functions/save_compra.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.text())
  .then(data => {
      console.log('Respuesta de save_compra:', data);

      // Suponiendo que save_compra.php devuelve el ID de la compra como respuesta
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
});

// Función de validación de tarjeta
function validarFormulario() {
  const tarjetaNumero = document.getElementById('card-number').value;
  const tarjetaNombre = document.getElementById('card-name').value;
  const tarjetaExpiracion = document.getElementById('card-expiry').value;
  const tarjetaCVV = document.getElementById('card-cvv').value;

  if (!tarjetaNumero || !tarjetaNombre || !tarjetaExpiracion || !tarjetaCVV) {
      alert('Por favor, complete todos los campos.');
      return false;
  }

  if (!/^[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}$/.test(tarjetaNumero)) {
      alert('Número de tarjeta inválido.');
      return false;
  }

  if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(tarjetaExpiracion) || validarFechaExpiracion(tarjetaExpiracion)) {
      alert('Fecha de expiración inválida.');
      return false;
  }

  if (tarjetaCVV.length !== 3) {
      alert('Código de seguridad (CVV) inválido.');
      return false;
  }

  return true;
}

// Función para validar fecha de expiración
function validarFechaExpiracion(value) {
const [month, year] = value.split('/').map(Number);
const currentDate = new Date();
const currentMonth = currentDate.getMonth() + 1;
const currentYear = currentDate.getFullYear() % 100; // Últimos 2 dígitos del año

if (year < currentYear || (year === currentYear && month < currentMonth)) {
  return 'La fecha de expiración no puede ser anterior a la fecha actual.';
}
return '';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
const card = document.getElementById('card');
const numberInput = document.getElementById('card-number');
const nameInput = document.getElementById('card-name');
const expiryInput = document.getElementById('card-expiry');
const cvvInput = document.getElementById('card-cvv');

const numberError = document.getElementById('number-error');
const nameError = document.getElementById('name-error');
const expiryError = document.getElementById('expiry-error');
const cvvError = document.getElementById('cvv-error');

// Función para validar fecha de expiración
function validarFechaExpiracion(value) {
  const [month, year] = value.split('/').map(Number);
  const currentDate = new Date();
  const currentMonth = currentDate.getMonth() + 1;
  const currentYear = currentDate.getFullYear() % 100; // Últimos 2 dígitos del año

  if (year < currentYear || (year === currentYear && month < currentMonth)) {
    return 'La fecha de expiración no puede ser anterior a la fecha actual.';
  }
  return '';
}

// Validación de número de tarjeta
numberInput.addEventListener('input', (e) => {
  const value = e.target.value.replace(/\D/g, '');
  const formattedValue = value.match(/.{1,4}/g)?.join(' ') || '';
  e.target.value = formattedValue;

  document.getElementById('display-number').textContent = formattedValue || '#### #### #### ####';

  numberError.textContent = value.length !== 16 ? 'Debe contener 16 dígitos.' : '';
});

// Validación de nombre
nameInput.addEventListener('input', (e) => {
  const value = e.target.value;
  if (/[^a-zA-Z\s]/.test(value)) {
    nameError.textContent = 'Solo se permiten letras y espacios.';
  } else {
    nameError.textContent = '';
    document.getElementById('display-name').textContent = value || 'NOMBRE APELLIDO';
  }
});

// Validación de expiración
expiryInput.addEventListener('input', (e) => {
  const value = e.target.value.replace(/\D/g, '');
  const formattedValue = value.length > 2 ? value.slice(0, 2) + '/' + value.slice(2, 4) : value;
  e.target.value = formattedValue;
  document.getElementById('display-expiry').textContent = formattedValue || 'MM/AA';

  if (formattedValue.length === 5) {
    expiryError.textContent = validarFechaExpiracion(formattedValue);
  } else {
    expiryError.textContent = 'Debe tener el formato MM/AA.';
  }

  if (formattedValue.length === 5) {
    card.style.transform = 'rotateY(0deg)';
  }
});

// Validación de código de seguridad
cvvInput.addEventListener('input', (e) => {
  const value = e.target.value.replace(/\D/g, '');
  e.target.value = value;
  document.getElementById('display-cvv').textContent = value || '###';

  cvvError.textContent = value.length !== 3 ? 'Debe contener 3 dígitos.' : '';

  if (value.length === 3) {
    card.style.transform = 'rotateY(180deg)';
  }
});

// Regresar la tarjeta cuando otro campo esté completo
[nameInput, numberInput, expiryInput].forEach(input =>
  input.addEventListener('blur', () => {
    if (!cvvInput.value) {
      card.style.transform = 'rotateY(0deg)';
    }
  })
);

// Validación del formulario antes de enviar
function validarFormulario() {
  const tarjetaNumero = numberInput.value;
  const tarjetaNombre = nameInput.value;
  const tarjetaExpiracion = expiryInput.value;
  const tarjetaCVV = cvvInput.value;

  if (!tarjetaNumero || !tarjetaNombre || !tarjetaExpiracion || !tarjetaCVV) {
    alert('Por favor, complete todos los campos.');
    return false;
  }

  if (!/^[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}$/.test(tarjetaNumero)) {
    alert('Número de tarjeta inválido.');
    return false;
  }

  if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(tarjetaExpiracion) || validarFechaExpiracion(tarjetaExpiracion)) {
    alert('Fecha de expiración inválida.');
    return false;
  }

  if (tarjetaCVV.length !== 3) {
    alert('Código de seguridad (CVV) inválido.');
    return false;
  }

  return true;
}

document.querySelector('#orderForm').onsubmit = function (event) {
  if (!validarFormulario()) {
    event.preventDefault();
  }
};