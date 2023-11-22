<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>NUM</td>
        </tr>
       
        <?php 
        $pos = 0; 
        foreach($_SESSION['selecciones'] as $pedido):?>
            <tr>
                <td><?=$pedido->getProducto()->getID()?></td>
                <td><?=$pedido->getProducto()->getNombre()?></td>
                <td><?=$pedido->getProducto()->getPrecio()?>€</td>
                <td><?=$pedido->getCantidad()?></td>
                <td><?=$pedido->devuelvePrecio()?></td>

                <form action=<?="?controller=producto&action=compra"?> method="POST">
                    <td><button type="submit" name='Add' value=<?=$pos?>>+</button></td>
                    <td><button type="submit" name='Del' value=<?=$pos?>>-</button></td>
                </form>
            </tr>
            
        <?php $pos ++; endforeach ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Precio final pedido</td>
            <td><?=CalculadoraPrecios::calculadorPrecioPedido($_SESSION['selecciones'])?></td>
            <form action=<?="?controller=producto&action=confirmar"?> method="POST">
                <td><button type="submit">Confirmar</button></td>
            </form>
            <td></td>
        </tr>
    </table>
</body>
</html>

