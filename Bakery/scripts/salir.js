/////////////////////////////////////////////////////////////////////////// Salir de la sesion
function confirmarSalida() {
        var confirmation = confirm("¿Estás seguro de que quieres cerrar sesión?");
        if (confirmation) {
            window.location.href = "logout.php";  // Si acepta, redirige al logout.
        } else {
            // Si cancela, no hace nada (se mantiene en la misma página).
            return false;
        }
    }

///////////////////////////////////////////////////////////////////////////  alert para admin 
    function confirmDelete() {
        return confirm('¿Estás seguro de que deseas desactivar a este administrador?');
    }

