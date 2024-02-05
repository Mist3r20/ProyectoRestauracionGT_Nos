document.addEventListener('DOMContentLoaded', function () {
    fetch('http://testnos.com/index.php/?controller=api&action=api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            accion: 'mostrarPuntos'
        }),
    }).then(response => response.json())
        .then(data => {
            mostrarPuntosActuales(data);

            let checkboxDescuento = document.getElementById('aplicarDescuento');
            let precioFinal = document.getElementById('precioFinal');
            let precioConDescuento = document.getElementById('precioConDescuento');
            let descuentoAplicado = document.getElementById('descuentoAplicado');
            let precioInicial = parseFloat(precioFinal.getAttribute('data-precio')); // Guardar el precio inicial sin descuento
            let maxPuntosUsuario = parseInt(data); // Obtener el máximo de puntos disponibles
            let descuentoSection = document.getElementById('descuentoSection');

            // Después de obtener descuentoSection en tu código JavaScript
            descuentoSection.innerHTML = `
            <label for="cantidadPuntos">Cantidad de puntos a usar:</label>
            <input type="number" id="cantidadPuntos" name="cantidadPuntos" min="0" max="${maxPuntosUsuario}">
            `;

            checkboxDescuento.addEventListener('change', function () {
                // Mostrar u ocultar la sección de descuento
                descuentoSection.style.display = checkboxDescuento.checked ? 'block' : 'none';

                // Llama a la función actualizarPrecio cuando cambia el checkbox
                actualizarPrecio(checkboxDescuento, precioFinal, precioConDescuento, descuentoAplicado, precioInicial, maxPuntosUsuario);
            });

            let puntosDisponibles = document.getElementById('cantidadPuntos');
            puntosDisponibles.addEventListener('input', function () {
                // Llama a la función actualizarPrecio cuando hay un cambio en el input
                actualizarPrecio(checkboxDescuento, precioFinal, precioConDescuento, descuentoAplicado, precioInicial, maxPuntosUsuario);
            });

            // Ajustar el valor inicial del campo de puntos
            puntosDisponibles.value = Math.min(maxPuntosUsuario, puntosDisponibles.value);
            actualizarPrecio(checkboxDescuento, precioFinal, precioConDescuento, descuentoAplicado, precioInicial, maxPuntosUsuario);
        })
        .catch(error => {
            console.log(error);
        });
});

function mostrarPuntosActuales(data) {
    let puntos = document.getElementById('puntosUsuario');

    // Limpiar contenido previo
    puntos.innerHTML = '';

    let mostrarPuntos = document.createElement('span');
    mostrarPuntos.textContent = `Puntos disponibles: ${data}`;
    puntos.appendChild(mostrarPuntos);
}

function actualizarPrecio(checkboxDescuento, precioFinal, precioConDescuento, descuentoAplicado, precioInicial) {
    let precioTotal = parseFloat(precioInicial); // Utilizar el precio inicial sin descuento


    // Lógica para calcular los puntos independientemente del descuento aplicado
    let tasaPuntosGanados = 0.5;
    let puntosGanados = Math.round(precioTotal * tasaPuntosGanados);

    // Actualizar el campo oculto con los puntos ganados
    puntosGanados = isNaN(puntosGanados) ? 0 : puntosGanados;
    document.getElementById('puntosGanados').textContent = `Puntos ganados: ${puntosGanados}`;

    if (checkboxDescuento.checked) {
        let puntosDisponibles = document.getElementById('cantidadPuntos').value;
        let tasaDescuento = 0.1;
        let descuento = puntosDisponibles * tasaDescuento;

        // Aplicar el descuento solo si hay puntos suficientes

        precioTotal -= descuento;

        // Actualizar el campo oculto con el nuevo precio
        precioConDescuento.value = precioTotal.toFixed(2);

        // Indicar que se ha aplicado el descuento
        descuentoAplicado.value = puntosDisponibles;

    } else {
        // Si no se aplica el descuento, resetear el campo oculto y la indicación
        precioConDescuento.textContent = precioTotal.toFixed(2);
        descuentoAplicado.value = "0";
    }

    // Actualizar el precio visible en la interfaz
    precioFinal.textContent = precioTotal.toFixed(2) + ' €';
}
