document.addEventListener('DOMContentLoaded', function () {
    // Obtener información de puntos disponibles mediante una llamada a la API
    fetch('https://edgarnos.bernat2024.es/index.php/?controller=api&action=api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            accion: 'mostrarPuntos'
        }),
    }).then(response => response.json())
        .then(data => {
            // Mostrar los puntos disponibles en la interfaz
            mostrarPuntosActuales(data);

            // Obtener referencias a elementos HTML relevantes
            let checkboxPropina = document.getElementById('aplicarPropina');
            let checkboxDescuento = document.getElementById('aplicarDescuento');
            let precioFinal = document.getElementById('precioFinal');
            let precioConDescuento = document.getElementById('precioConDescuento');
            let descuentoAplicado = document.getElementById('descuentoAplicado');
            let propinaAplicar = document.getElementById('cantidadPropina');
            let puntosGanadosElement = document.getElementById('puntosGanados');
            let precioInicial = parseFloat(precioFinal.getAttribute('data-precio')); // Guardar el precio inicial sin descuento ni propina
            let maxPuntosUsuario = parseInt(data); // Obtener el máximo de puntos disponibles
            let descuentoSection = document.getElementById('descuentoSection');

            // Configurar la sección de descuento
            descuentoSection.innerHTML = `
            <label for="cantidadPuntos">Cantidad de puntos a usar:</label>
            <input type="number" id="cantidadPuntos" name="cantidadPuntos" min="0" max="${maxPuntosUsuario}">
            `;

            // Configurar eventos para el checkbox de propina
            checkboxPropina.addEventListener('change', function () {
                actualizarPrecio(checkboxPropina, precioFinal, precioConDescuento, descuentoAplicado, propinaAplicar, precioInicial, maxPuntosUsuario);
            });

            // Configurar evento para el input de propina
            propinaAplicar.addEventListener('input', function () {
                actualizarPrecio(checkboxPropina, precioFinal, precioConDescuento, descuentoAplicado, propinaAplicar, precioInicial, maxPuntosUsuario);
            });

            // Ajustar el valor inicial del campo de propina
            propinaAplicar.value = Math.min(100, propinaAplicar.value);
            actualizarPrecio(checkboxPropina, precioFinal, precioConDescuento, descuentoAplicado, propinaAplicar, precioInicial, maxPuntosUsuario);

            // Configurar eventos para el checkbox de descuento por puntos
            checkboxDescuento.addEventListener('change', function () {
                descuentoSection.style.display = checkboxDescuento.checked ? 'block' : 'none';
                actualizarPrecio(checkboxPropina, precioFinal, precioConDescuento, descuentoAplicado, propinaAplicar, precioInicial, maxPuntosUsuario);
            });

            // Configurar evento para el input de puntos
            let puntosDisponibles = document.getElementById('cantidadPuntos');
            puntosDisponibles.addEventListener('input', function () {
                actualizarPrecio(checkboxPropina, precioFinal, precioConDescuento, descuentoAplicado, propinaAplicar, precioInicial, maxPuntosUsuario);
            });

            // Ajustar el valor inicial del campo de puntos
            puntosDisponibles.value = Math.min(maxPuntosUsuario, puntosDisponibles.value);
            actualizarPrecio(checkboxPropina, precioFinal, precioConDescuento, descuentoAplicado, propinaAplicar, precioInicial, maxPuntosUsuario);
        })
        .catch(error => {
            console.log(error);
        });
});

// Función para mostrar los puntos disponibles en la interfaz
function mostrarPuntosActuales(data) {
    let puntos = document.getElementById('puntosUsuario');

    // Limpiar contenido previo
    puntos.innerHTML = '';

    // Crear elemento span para mostrar los puntos disponibles
    let mostrarPuntos = document.createElement('span');
    mostrarPuntos.textContent = `Puntos disponibles: ${data}`;
    puntos.appendChild(mostrarPuntos);
}

// Función para actualizar el precio en la interfaz
function actualizarPrecio(checkboxPropina, precioFinal, precioConDescuento, descuentoAplicado, propinaAplicar, precioInicial, maxPuntosUsuario) {
    let precioTotal = parseFloat(precioInicial); // Utilizar el precio inicial sin descuento ni propina

    // Obtener el campo oculto de propina aplicada
    let propinaAplicadaCampo = document.getElementById('propinaAplicada');
    let porcentajeAplicado = document.getElementById('porcentajeAplicado');
    let puntosGanadosCampo = document.getElementById('puntosGanados');

    // Lógica para aplicar la propina si el checkbox de propina está marcado
    if (checkboxPropina.checked) {
        let porcentajePropina = parseFloat(propinaAplicar.value) || 0;
        let propina = precioTotal * (porcentajePropina / 100);

        // Aplicar la propina al precio total
        precioTotal += propina;

        // Actualizar el campo visible con el nuevo precio
        precioFinal.textContent = precioTotal.toFixed(2) + ' €';

        // Indicar que se ha aplicado propina
        let propinaAplicadaElement = document.getElementById('mensajePropina');
        propinaAplicadaElement.innerHTML = `Propina aplicada: ${propina.toFixed(2)} €`;

        // Actualizar el valor del campo oculto de propina aplicada
        propinaAplicadaCampo.value = propina.toFixed(2);
        porcentajeAplicado.value = porcentajePropina;
    } else {
        // Si no se aplica la propina, resetear el campo oculto y la indicación
        // Indicar que se ha aplicado propina
        let propinaAplicadaElement = document.getElementById('mensajePropina');
        propinaAplicadaElement.innerHTML = `Propina aplicada: 0€`;
        
        // Restablecer el valor del campo oculto de propina aplicada a 0
        propinaAplicadaCampo.value = "0";
        porcentajeAplicado.value = "0";
    }

    // Lógica para aplicar descuento por puntos
    let checkboxDescuento = document.getElementById('aplicarDescuento');
    if (checkboxDescuento.checked) {
        let puntosDisponibles = document.getElementById('cantidadPuntos').value;
        let tasaDescuento = 0.1;
        let descuento = puntosDisponibles * tasaDescuento;

        // Aplicar el descuento solo si hay puntos suficientes
        if (descuento <= precioTotal && puntosDisponibles <= maxPuntosUsuario) {
            precioTotal -= descuento;

            // Verificar si el precio total llega a 0€
            if (precioTotal <= 0) {
                // Restablecer el campo oculto y la indicación
                precioConDescuento.textContent = "0.00";
                descuentoAplicado.value = "0";
                
                // Mostrar un mensaje indicando que no se pueden aplicar más puntos
                alert("No se pueden aplicar más puntos, el pedido ya es gratuito.");
                
                // Desmarcar el checkbox de descuento por puntos
                checkboxDescuento.checked = false;
                descuentoSection.style.display = 'none';
            } else {
                // Actualizar el campo oculto con el nuevo precio
                precioConDescuento.value = precioTotal.toFixed(2);

                // Indicar que se ha aplicado el descuento
                descuentoAplicado.value = puntosDisponibles;
            }
        } else {
            // Restablecer el campo oculto y la indicación
            precioConDescuento.textContent = precioTotal.toFixed(2);
            descuentoAplicado.value = "0";
        }
    } else {
        // Si no se aplica el descuento, resetear el campo oculto y la indicación
        precioConDescuento.textContent = precioTotal.toFixed(2);
        descuentoAplicado.value = "0";
    }

    // Calcular y mostrar los puntos ganados con la próxima compra
    let tasaPuntosGanados = 0.5;
    let puntosGanados = Math.round(precioTotal * tasaPuntosGanados);
    puntosGanadosCampo.textContent = `Puntos ganados en esta compra: ${puntosGanados}`;
    puntosGanadosCampo.value = puntosGanados;
    
    // Actualizar el precio visible en la interfaz
    precioFinal.textContent = precioTotal.toFixed(2) + ' €';
}
