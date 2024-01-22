document.addEventListener('DOMContentLoaded', function(){
    const formulario = document.getElementById('ComentsForm');

    formulario.addEventListener('submit', function(evento){
       evento.preventDefault();
       
       //Obtenemos valores del Formulario
       const comentario = document.getElementById('comentario').value;
       const puntuacion = obtenerPuntuacion();

        //Realizamos solicitud fetch para enviar los datos al servidor
        fetch('http://testnos.com/index.php/?controller=api&action=api',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', // Tipo de contenido ahora es JSON
        },
        body: new URLSearchParams({
            accion: 'agregarComentario',
            comentario: comentario,
            puntuacion: puntuacion
        }),
        }).then(response => response.json())
        .then(data => {
            console.log('Comentario enviado exitosamente: ',data);
        }).catch(error =>{
            console.log('Error al enviar comentario: ',error);
        });
    });

    function obtenerPuntuacion(){
        const estrellas = document.querySelectorAll('.ubicacion input[name="rate"]');
        let puntuacion = 0;

        estrellas.forEach(estrella => {
            if(estrella.checked){
                puntuacion = estrella.value;
            }
        });

        return puntuacion;
    }
});