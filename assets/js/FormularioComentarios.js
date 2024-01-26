document.addEventListener('DOMContentLoaded', function(){
    const formulario = document.getElementById('ComentsForm');

    formulario.addEventListener('submit', function(evento){
        evento.preventDefault();
       
       //Obtenemos valores del Formulario
       const comentario = document.getElementById('comentario').value;
       const puntuacion = obtenerPuntuacion();
       const idPedido = document.getElementById('idPedido').value;
        
       const formData = new FormData();
        formData.append('accion', 'agregarComentario');
        formData.append('comentario', comentario);
        formData.append('puntuacion', puntuacion);
        formData.append('idPedido', idPedido);

        //Realizamos solicitud fetch para enviar los datos al servidor
        fetch('http://testnos.com/index.php/?controller=api&action=api', {
            method: 'POST',
            body: formData,
        }).then(response => response.json())
        .then(data => {
            notie.alert({
                type: 'success',
                text: 'Comentario añadido correctamente',
                time: 2,
            });
            setTimeout(function() {
                window.location.href = 'http://testnos.com/index.php/?controller=usuario&action=pedidos';
            }, 2000);
        }).catch(error =>{
            notie.alert({
                type: 'error',
                text: 'Ha ocurrido un problema al añadir tu comentario, prueba de nuevo más tarde',
                time: 2,
            });

            // Redireccionar después de 2 segundos
            setTimeout(function() {
                window.location.href = 'http://testnos.com/index.php/?controller=usuario&action=pedidos';
            }, 2000);
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