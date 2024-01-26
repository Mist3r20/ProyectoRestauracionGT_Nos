document.addEventListener('DOMContentLoaded', function(){
    let BotonAddComentarios = document.querySelectorAll('.BotonAddComentarios');
 
    BotonAddComentarios.forEach(boton => {
         let idPedido = boton.getAttribute('data-pedido-id');
         
         fetch('http://testnos.com/index.php/?controller=api&action=api', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/x-www-form-urlencoded',
             },
             body: new URLSearchParams({
                 accion: 'mostrarBoton',
                 id: idPedido,
             }),
         }).then(response => response.json())
         .then(data =>{
             
             //Funcion del boton
             mostrarBoton(data, boton);
         }).catch(error => {
             console.log(error);
         });
    });
 });
 
 function mostrarBoton(true_false, boton) {
    let labelNewComentario = boton.querySelector('.labelNewComentario');
    let buttonNewComentario = boton.querySelector('.buttonNewComentario');
    
    if (true_false == false){
        labelNewComentario.remove();
    } else {
        buttonNewComentario.remove();
    }
}

 