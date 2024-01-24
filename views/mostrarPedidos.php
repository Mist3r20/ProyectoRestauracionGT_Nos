<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/comentariosForm_estil.css" rel="stylesheet" type="text/css" media="screen">
    <title>Pedidos Realizados</title>
</head>
<body>

<div class="container">
    <div class="row seccionesMAX1">
        <div class="col-md- mb-4">
            <p class="titulo-carrito">Pedidos Realizados</p>
            <?php foreach($Pedidos as $pedido): ?>
            <div class="producto">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row linea-separatoria2">
                            <div class="col-6">
                                <p class="nombre-producto">Numero de Pedido: <span class="id"><?=$pedido['pedido_id']?></span></p>
                                <p class="nombre-producto">Fecha: <?= $pedido['pedido_fecha'] ?></p>
                                <p class="nombre-producto">Cantidad Total: <?= number_format($pedido['pedido_precioTotal'], 2) ?>€</p>
                            </div>
                            <div class="col-6 text-right">
                                <form action="?controller=producto&action=VerDetallesPedido" method="POST">
                                    <input type="hidden" name="ver" value=<?= $pedido['pedido_id'] ?>>
                                    <button class="redirect-button">Ver Pedido</button>
                                </form>
                                <div class="BotonAddComentarios" data-pedido-id="<?=$pedido['pedido_id']?>">
                                  <form action="?controller=comentarios&action=FormularioComentarios" method="POST">
                                    <input type="hidden" name="addComentario" value=<?=$pedido['pedido_id']?>>
                                    <label class="labelNewComentario">Ya has añadido un comentario</label>
                                    <button class="redirect-button buttonNewComentario">Añadir Comentario</button>
                                  </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="../assets/js/BotonComentario.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
