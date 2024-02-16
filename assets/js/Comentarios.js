// Espera a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function () {
    // Realiza una solicitud fetch a la API para obtener datos de comentarios
    fetch('https://edgarnos.bernat2024.es/index.php/?controller=api&action=api', {
        method: 'POST', // Método HTTP POST utilizado para enviar datos al servidor
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Tipo de contenido de la solicitud
        },
        body: new URLSearchParams({
            accion: 'buscar_review', // Parámetros de la solicitud
        }),
    })
    .then(response => {
        // Devuelve la respuesta como JSON
        console.log(response);
        return response.json();
    })
    .then(data => {
        // Maneja los datos obtenidos llamando a la función mostrarComentario
        mostrarComentario(data);
        
        // Agrega eventos para cambios en los filtros y en el orden
        document.getElementById('orden').addEventListener('change', function () {
            aplicarFiltro(data);
        });
        
        document.querySelectorAll('.filtro-puntuacion').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                aplicarFiltro(data);
            });
        });
    })
    .catch(error => {
        // Maneja cualquier error que pueda ocurrir durante la solicitud o procesamiento
        console.error(error);
    });
});

// Creamos funcion para mostrar comentarios; objeto creados ahora en el mismo archivo sin SQL
function mostrarComentario(comentarios) {
    let reseñasPagina = document.querySelector('.reseñas-pagina', '.row');
    
    // Limpia el contenido existente en el contenedor
    while (reseñasPagina.firstChild) {
        reseñasPagina.removeChild(reseñasPagina.firstChild);
    }

    // Itera sobre los comentarios y crea elementos HTML para mostrarlos
    comentarios.forEach(comentario => {
        let divReseñas = document.createElement('div');
        divReseñas.classList.add('comentario', 'p-3', 'col-12', 'col-lg-2');

        divReseñas.innerHTML = `
            <div class="puntuacion mb-3">
                <strong>Puntuación:</strong> ${generarEstrellas(comentario.calificacion)}
            </div>
            <p class="mb-2 textoComentario">${comentario.texto}</p>
            <p>${comentario.ID_usuario}</p>
        `;

        reseñasPagina.appendChild(divReseñas);
    });
}

// Función para ordenar los comentarios
function ordenarComentarios(comentarios, orden) {
    if (orden === 'ascendente') {
        return comentarios.slice().sort((a, b) => b.calificacion - a.calificacion);
    } else {
        return comentarios.slice().sort((a, b) => a.calificacion - b.calificacion);
    }
}

// Función para filtrar comentarios por puntuación
function filtrarPorPuntuacion(comentarios, puntuacionesSeleccionadas) {
    if (puntuacionesSeleccionadas.length === 0) {
        return comentarios;
    }

    return comentarios.filter(comentario => puntuacionesSeleccionadas.includes(comentario.calificacion));
}

// Función para aplicar los filtros seleccionados
function aplicarFiltro(comentarios) {
    const orden = document.getElementById('orden').value;
    const checkboxes = document.querySelectorAll('.filtro-puntuacion:checked');
    const puntuacionesSeleccionadas = Array.from(checkboxes).map(checkbox => parseInt(checkbox.value));

    let reseñasFiltradas = ordenarComentarios(comentarios, orden);
    reseñasFiltradas = filtrarPorPuntuacion(reseñasFiltradas, puntuacionesSeleccionadas);

    mostrarComentario(reseñasFiltradas);
}

// Función para generar estrellas en función de la puntuación
const generarEstrellas = (puntuacion) => {
    const estrellas = '★'.repeat(puntuacion) + '☆'.repeat(5 - puntuacion);
    return `<span style="color: gold;">${estrellas}</span>`;
};

