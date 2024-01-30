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

        let checkboxDescuento = document.getElementById('aplicarDescuento');
        let puntosDisponibles = parseFloat(data);
        let precioFinal = document.getElementById('precioFinal');
        let precioConDescuento = document.getElementById('precioConDescuento');
        let descuentoAplicado = document.getElementById('descuentoAplicado');

        // Obtener el precio redondeado inicial para evitar que en el calculo no aparezcan numeros periodicos
        let precioRedondeado = Math.floor(parseFloat(precioFinal.getAttribute('data-precio')));

        // Actualizar el precio inicial
        actualizarPrecio(checkboxDescuento, puntosDisponibles, precioFinal, precioConDescuento, descuentoAplicado, precioRedondeado);

        checkboxDescuento.addEventListener('change', function(){
            actualizarPrecio(checkboxDescuento, puntosDisponibles, precioFinal, precioConDescuento, descuentoAplicado, precioRedondeado);
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

function actualizarPrecio(checkboxDescuento, puntosDisponibles, precioFinal, precioConDescuento, descuentoAplicado, precioRedondeado){
    let precioTotal = parseFloat(precioRedondeado);

    if (checkboxDescuento.checked){
        let tasaDescuento = 0.1;
        let descuento = puntosDisponibles * tasaDescuento;
        
        // Aplicar el descuento solo si hay puntos suficientes
        if (descuento <= precioTotal) {
            precioTotal -= descuento;

            // Actualizar el campo oculto con el nuevo precio
            precioConDescuento.value = precioTotal.toFixed(2);

            // Indicar que se ha aplicado el descuento
            descuentoAplicado.value = "1";
        } else {
            // Si no hay puntos suficientes, desmarcar la casilla
            checkboxDescuento.checked = false;

            // Restablecer los valores
            precioConDescuento.value = precioTotal.toFixed(2);
            descuentoAplicado.value = "0";
        }
    } else {
        // Si no se aplica el descuento, resetear el campo oculto y la indicación
        precioConDescuento.value = precioTotal.toFixed(2);
        descuentoAplicado.value = "0";
    }

    // Actualizar el precio visible en la interfaz
    precioFinal.textContent = precioTotal.toFixed(2);
}
