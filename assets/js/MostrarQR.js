document.addEventListener('DOMContentLoaded', function(){
  const checkForm = document.getElementById('enviarForm');

  checkForm.addEventListener('submit', function(event){
    event.preventDefault();

    const formData = new FormData(checkForm);

    fetch(checkForm.action, {
      method: checkForm.method,
      body: formData
    })
    .then(response =>{
      if(!response.ok){
        throw new Error('Error al enviar el formulario');
      }
      return response.json();
    })
    .then(data =>{
      let idUser = document.getElementById('ID').value;
      const url = 'https://edgarnos.bernat2024.es/index.php/?controller=producto&action=PaginaDetallesPedidoQR&ID='+idUser;
      
      const qr = new QRCode(document.createElement('div'), {
        text: url,
        width: 300,
        height: 300,
      });
      const canvas = qr._canvas;  

    const qrCodeDataUrl = canvas.toDataURL();

      Swal.fire({
        title: 'QR Detalles del Pedido',
        imageUrl: qrCodeDataUrl,
        imageAlt: 'Código QR',
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true,
        allowOutsideClick: false
    }).then(()=>{
      window.location.href = 'https://edgarnos.bernat2024.es/index.php';
    });
    }).catch(error =>{
      console.error(error);
    });
  });

});