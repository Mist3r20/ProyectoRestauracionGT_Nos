document.addEventListener('DOMContentLoaded', function(){

    fetch('http://tu-api.com/obtener_ultimo_pedido', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => mostrarDetallesPedido(data))
    .catch(error => console.error('Error al obtener detalles del pedido:', error));
});

function mostrarDetallesPedido(data) {
    const mensaje = document.getElementById('mensaje');
    mensaje.innerHTML = `<h1>¡Gracias por realizar tu pedido!</h1>
                         <p>Fecha del Pedido: ${data.fecha_pedido}</p>
                         <p>ID del Pedido: ${data.ID_pedido}</p>
                         <h2>Detalles del Pedido:</h2>
                         <ul>
                             ${data.detalles.map(detalle => `<li>Nombre del Producto: ${detalle.nombre_producto}</li>
                                                               <li>Cantidad: ${detalle.cantidad}</li>
                                                               <li>Precio por Cantidad: ${detalle.precio}</li>`).join('')}
                         </ul>
                         <p>Total del Pedido: ${data.total} €</p>`;
}
