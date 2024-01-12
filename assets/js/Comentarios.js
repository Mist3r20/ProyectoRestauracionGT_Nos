//Creamos funcion para mostrar comentarios objeto creados ahora en el mismo archivo sin SQL
function mostrarComentario(comentarios) {
    let reseñasPagina = document.querySelector('.reseñas-pagina','.row');
    reseñasPagina.innerHTML = ''; // Limpiar el contenido existente

    comentarios.forEach(comentario => {
        let divReseñas = document.createElement('div');
        divReseñas.classList.add('comentario', 'p-3', 'col-12', 'col-lg-2');

        divReseñas.innerHTML = `
            <div class="puntuacion mb-3">
                <strong>Puntuación:</strong> ${generarEstrellas(comentario.puntuacion)}
            </div>
            <p class="mb-2 textoComentario">${comentario.comentario}</p>
            <p>${comentario.nombre}</p>
        `;
        reseñasPagina.appendChild(divReseñas);
    });
}

const generarEstrellas = (puntuacion) => {
    const estrellas = '★'.repeat(puntuacion) + '☆'.repeat(5 - puntuacion);
    return `<span style="color: gold;">${estrellas}</span>`;
};

let reseñas = [
    { nombre: 'Genaro', comentario: 'Excelente serviciosdfasdfsdfsdfsdfsdfafs fweacvfrthgdfsfvgbrtgvedfvzgsgegdfcfvgsertvsdfergbergvageefgsvgvewgrergvf', puntuacion: 5 },
    { nombre: 'Lautaro', comentario: 'Buen trato', puntuacion: 4 },
    { nombre: 'Elisabeth', comentario: 'Podría mejorar serviciosdfasdfsdfsdfsdfsdfafsserviciosdfasdfsdfsdfsdfsdfafs', puntuacion: 3 },
    { nombre: 'Elisabeth', comentario: 'Podría mejorarserviciosdfasdfsdfsdfsdfsdfafsserviciosdfasdfsdfsdfsdfsdfafs', puntuacion: 3 },
    { nombre: 'Elisabeth', comentario: 'Podría mejorarserviciosdfasdfsdfsdfsdfsdfafsserviciosdfasdfsdfsdfsdfsdfafs', puntuacion: 3 },
    { nombre: 'Elisabeth', comentario: 'Podría mejorarvserviciosdfasdfsdfsdfsdfsdfafsserviciosdfasdfsdfsdfsdfsdfafs', puntuacion: 3 }
];

