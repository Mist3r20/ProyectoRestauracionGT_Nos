document.addEventListener('DOMContentLoaded', function(){
    fetch('http://testnos.com/index.php/?controller=api&action=api',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            accion: 'mostrarPuntos'
        }),
    }).then(response => response.json())
    .then(data => {
        mostrarPuntos(data);
        
        // Obtener elementos
        let checkboxDescuento = document.getElementById('aplicarDescuento');
        let puntosDisponibles = parseFloat(data); // Parsear como número decimal
        let precioFinal = document.getElementById('precioFinal');

        // Actualizar el precio inicial
        actualizarPrecio(checkboxDescuento, puntosDisponibles, precioFinal);

        // Agregar evento al cambio de la casilla
        checkboxDescuento.addEventListener('change', function(){
            actualizarPrecio(checkboxDescuento, puntosDisponibles, precioFinal);
        });
    })
    .catch(error => {
        console.log(error);
    });

});

function mostrarPuntos(data){
    let puntos = document.getElementById('puntosUsuario');

    // Limpiar contenido previo
    puntos.innerHTML = '';

    let mostrarPuntos = document.createElement('span');
    mostrarPuntos.textContent = `Puntos disponibles: ${data}`;
    puntos.appendChild(mostrarPuntos);
}

// Función para actualizar el precio final
function actualizarPrecio(checkboxDescuento, puntosDisponibles, precioFinal){
    let precioTotal = parseFloat(precioFinal.getAttribute('data-precio'));

    if (checkboxDescuento.checked){
        let tasaDescuento = 0.1; // Ajusta la tasa de descuento según sea necesario
        let descuento = puntosDisponibles * tasaDescuento;
        precioTotal -= descuento;
        precioTotal = Math.max(precioTotal, 0);
    }

    precioFinal.textContent = precioTotal.toFixed(2);
}
