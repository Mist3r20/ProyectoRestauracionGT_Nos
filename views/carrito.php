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
      
      <div class="col-md-8 mb-4">
        <p class="titulo-carrito">Productos en la cesta</p>
        
          <?php
            $pos=0;
            foreach($_SESSION['selecciones'] as $pedido){
              $producto = $pedido->getProducto();
              if($producto instanceof Bebidas && method_exists($producto, 'getMl')){
                $ml = $producto->getMl()."ml";
              }else{
                $ml = '';
              }
          ?>
          <div class="producto">
            <div class="row">
              <div class="col-md-2">
                <div class="imagen-producto">
                  <img src="data:image/jpeg; base64,<?=base64_encode($pedido->getProducto()->getFoto())?>" alt="<?=$pedido->getProducto()->getDescripcion()?>" class="imagen"/>
                </div>
              </div> 
              <div class="col-md-10">
                <div class="row linea-separatoria2">
                  <div class="col-7">
                    <p class="nombre-producto"><?=$pedido->getProducto()->getNombre()?> <?=$ml?></p>
                  </div>
                  <div class="col-3 d-flex justify-content-center">
                    <form action=<?="?controller=producto&action=carrito"?> method="POST">
                      <button class="unidades button-unidades" type="submit" name="Del" value=<?=$pos?>>-</button>
                      <button class="unidades button-unidades"><?=$pedido->getCantidad()?></button>
                      <button class="unidades button-unidades" type="submit" name="Add" value=<?=$pos?>>+</button>
                    </form>
                  </div>
                  <div class="col-2 text-right">
                    <p class="nombre-producto"><?= number_format($pedido->devuelvePrecio(),2)?>€</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <form action="<?="?controller=producto&action=carrito"?>" method="POST">
                      <button class="btn eliminar" type="submit" name="eliminar" value=<?=$pos?>>ELIMINAR</button>
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $pos++; }?>
      </div>
      
      <div class="col-md-4 mb-4 align-precios">
        <div class="carrito-lleno">
          <div class="row carrito-subtotal">
            <div class="col-8 text-right">
              <span>Subtotal: </span>
            </div>
            <div class="col-4 text-right">
              <span><?=calculadoraPrecios::calculadorPrecioPedido($_SESSION['selecciones'])?> €</span>
            </div>
          </div>
          <div class="row carrito-iva">
            <div class="col-8 text-right">
              <span>IVA 10%: </span>
            </div>
            <div class="col-4 text-right">
              <span><?=calculadoraPrecios::calculaIVAPedido($_SESSION['selecciones'])?> €</span>
            </div>
          </div>
          <div class="row carrito-gastos-envio">
            <div class="col-8 text-right bold">
              <span>Gastos de envío: *</span>
              <span class="postal">* Se calculan ségun tu código postal</span>
            </div>
            <div class="col-4 text-right bold">
              <span>GRATIS</span>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="linea-separatoria-negra"></div>
            </div>
          </div>
          <div class="row carrito-total">
            <div class="col-8 text-right">
              <span>Total: </span>
            </div>
            <div class="col-4 text-right">
              <span><?=calculadoraPrecios::calculadorTotalPedido($_SESSION['selecciones'])?> €</span>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="btn-ver-cesta text-center">
                <form action=<?="?controller=producto&action=confirmar&estado=finalizado"?> method="POST">
                  <input type="hidden" name="cantidadFinal" value=<?=calculadoraPrecios::calculadorTotalPedido($_SESSION['selecciones'])?>>
                  <button type="submit" class="btn button-finalizar">FINALIZAR</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>