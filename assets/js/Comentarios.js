//Creamos funcion para mostrar comentarios objeto creados ahora en el mismo archivo sin SQL
function mostrarComentario(comentarios){
    let reseñasPagina = document.querySelector('.reseñas-pagina');
    
    comentarios.forEach(comentario => {
        let divReseñas = document.createElement('div');
        divReseñas.classList.add('comentario');
        divReseñas.innerHTML = `
            <p><strong>Puntuación:</strong> ${generarEstrellas(comentario.puntuacion)}</p>
            <p>${comentario.comentario}</p>
            <p> ${comentario.nombre}</p>
            <hr>
        `;
        reseñasPagina.appendChild(divReseñas);
    });
}

const generarEstrellas = (puntuacion) => {
    const estrellas = '★'.repeat(puntuacion) + '☆'.repeat(5 - puntuacion);
    return `<span style="color: gold;">${estrellas}</span>`;
};

let reseñas = [
    { nombre: 'Genaro', comentario: 'Excelente servicio', puntuacion: 5 },
    { nombre: 'Lautaro', comentario: 'Buen trato', puntuacion: 4 },
    { nombre: 'Elisabeth', comentario: 'Podría mejorar', puntuacion: 3 }
];

