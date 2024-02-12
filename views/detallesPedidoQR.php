<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/carrito_estil.css" rel="stylesheet" type="text/css" media="screen">
  <link href="../assets/css/pedidoQR_estil.css" rel="stylesheet" type="text/css" media="screen">
  <link href="../assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">

  <title>Confirmación de Pedido</title>
</head>

<body>

  <div class="container">
    <div class="row seccionesMAX1">

      <div class="col-md-8 mb-4">
        <p class="titulo-carrito">¡Gracias por tu pedido!</p>
        <p class="nombre-producto">ID del Pedido: <?= $primerPedidoID?></p>
        <p class="nombre-producto">Fecha del Pedido: <?= $primerPedidoFecha?></p>

        <?php
        
        foreach ($productos as $pedido) {
          $producto = $pedido->getProducto();
          if ($producto instanceof Bebidas && method_exists($producto, 'getMl')) {
            $ml = $producto->getMl() . "ml";
          } else {
            $ml = '';
          }
        ?>
          <div class="producto mt-20">
            <div class="row">
              <div class="col-md-2">
                <div class="imagen-producto">
                  <img src="data:image/jpeg; base64,<?= base64_encode($pedido->getProducto()->getFoto()) ?>" alt="<?= $pedido->getProducto()->getDescripcion() ?>" class="imagen" />
                </div>
              </div>
              <div class="col-md-10">
                <div class="row linea-separatoria2">
                  <div class="col-6">
                    <p class="nombre-producto"><?= $pedido->getProducto()->getNombre() ?> <?= $ml ?></p>
                    <p class="nombre-producto">Cantidad: <?= $pedido->getCantidad() ?></p>
                  </div>

                  <div class="col-2 text-right">
                    <p class="nombre-producto">TOTAL: <?= number_format($pedido->getProducto()->getPrecio(), 2) ?>€</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="resumen-pedido">
          <p class="nombre-producto">Precio Total: <?= number_format($pedido->getPrecioTotal(), 2) ?>€</p>
          <p class="nombre-producto">Puntos Utilizados Total: <?= $pedido->getPuntosUsados() ?></p>
          <p class="nombre-producto">Propina: <?= $pedido->getPorcentajeAplicado() ?>% (<?= $pedido->getPropinaAplicada() ?>€)</p>
        </div>
        <form action="?controller=usuario&action=pedidos" method="POST">
          <button class="redirect-button">Volver Atrás</button>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>