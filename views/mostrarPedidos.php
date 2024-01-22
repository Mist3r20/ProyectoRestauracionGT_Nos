<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/carrito_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
    
    <title>Carrito</title>
</head>
<body>
  
  <div class="container">
    <div class="row seccionesMAX1">
      
      <div class="col-md- mb-4">
        <p class="titulo-carrito">Pedidos Realizados</p>
        
          <?php
            
            foreach($Pedidos as $pedido){
              
          ?>
          <div class="producto">
            <div class="row"> 
              <div class="col-md-10">
                <div class="row linea-separatoria2">
                  <div class="col-6">
                    <p class="nombre-producto">Numero de Pedido: <?=$pedido['pedido_id']?></p>
                    <p class="nombre-producto">Fecha: <?=$pedido['pedido_fecha']?></p>
                    <p class="nombre-producto">Cantidad Total: <?= number_format($pedido['pedido_precioTotal'],2)?>€</p>
                  </div>
                  
                  <div class="col-2 text-right">
                  <form action="?controller=producto&action=VerDetallesPedido" method="POST">
                    <input type="hidden" name="ver" value=<?=$pedido['pedido_id']?>>
                    <button class="redirect-button" >VER PEDIDO</button>
                  </form>
                  </div>
                </div>
                <div class="row">
                </div>
              </div>
            </div>
          </div>
          <?php }?>
      </div>
    </div>
  </div>
    
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>