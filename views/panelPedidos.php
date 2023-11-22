<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $tipo = "Entrantes";
        $productos = ProductoDAO::getAllProductsType($tipo);
        if(!empty($productos)){
        }else{
            echo "No se han encontrado datos";
        }
        
    ?>
    
    <h2><?=$tipo?></h2>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Precio</td>
        </tr>
        <?php foreach($productos as $producto):?>
            <tr>
                <td><?=$producto->getID()?></td>
                <td><?=$producto->getNombre()?></td>
                <td><?=$producto->getPrecio()?>€</td>
                <td>
                    <form action=<?="?controller=producto&action=editar"?> method="POST">
                        <input name="ID" value=<?=$producto->getID()?> hidden>
                        <button type="submit">Modificar</button>
                    </form>
                </td>
                <td>
                    <form action=<?="?controller=producto&action=eliminar"?> method="POST">
                    <input name="ID" value=<?=$producto->getID()?> hidden>
                    <button type="submit">Eliminar</button>
                    </form>
                </td>
                <td>
                <form action=<?="?controller=producto&action=sel"?> method="POST">
                        <input name="ID" value=<?=$producto->getID()?> hidden>
                        <button type="submit">Añadir</button>
                    </form>
                </td>
            </tr>
            
        <?php endforeach ?>
    </table>
    


   <h2>Todos los productos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
        </tr>
        <?php foreach($productos as $producto):?>
            <tr>
                <td><?=$producto->getID()?></td>
                <td><?=$producto->getNombre()?></td>
                <td><?=$producto->getPrecio()?>€</td>
            </tr>
        <?php endforeach ?>
    </table>



</body>
</html>

