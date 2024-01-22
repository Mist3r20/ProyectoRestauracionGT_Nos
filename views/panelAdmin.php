<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/panelAdmin_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    
    <title>Panel Administrador</title>
</head>
<body>
    <div class="seccionesMAX1">
        <h1>Productos</h1>
        <form action="?controller=producto&action=crear" method="POST">
	        <button class="boton-carta">CREAR</button> 
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripcion</th>
                <th>Nombre Categoria</th>
                <th>Foto</th>
                <th></th>
            </tr>
            <?php
                foreach($allProducts as $producto){
            ?>
            <tr>
                <td><?= $producto->getID()?></td>
                <td><?= $producto->getNombre()?></td>
                <td><?= $producto->getPrecio()?></td>
                <td><?= $producto->getDescripcion()?></td>
                <td><?= $producto->getNombre_categoria()?></td>
                <td><img class="imagen" src="data:image/jpeg; base64,<?=base64_encode($producto->getFoto())?>" alt="<?=$producto->getDescripcion()?>"></td>
                <td>
                    <form action="?controller=producto&action=editar" method="POST">
                        <input name="ID" value=<?=$producto->getID()?> type="hidden">
                        <button class="boton-carta">EDITAR</button> 
                    </form>
                    <form action="?controller=producto&action=eliminar" method="POST">
                        <input name="ID" value=<?=$producto->getID()?> type="hidden">
                        <button class="boton-carta">ELIMINAR</button> 
                    </form>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</body>




</html>