<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
    <form action=<?=url."?controller=producto&action=actualizar"?> method="POST">
        <input name="idDis" disabled value="<?=$producto->getId()?>"/>
        <input name="id_producto" type="number" hidden value="<?=$producto->getId()?>"/>
        </br>
        <input name="nombre" type="text" value="<?=$producto->getNombre()?>"/>
        </br>
        <input name="precio" type="number" value="<?=$producto->getPrecio()?>"/>
        </br>
        <input name="descripcion" type="text" value="<?=$producto->getDescripcion()?>"/>
        </br>
        <input name="nombreCategoriaDis" disabled value="<?=$producto->getNombre_categoria()?>"/>
        </br>
        <select name="IDCategoria">
            <option type="number" value="1" <?php if($producto->getNombre_categoria() == "Entrantes") echo "Selected";?>>Entrantes</option>
            <option type="number" value="2" <?php if($producto->getNombre_categoria() == "Principales") echo "Selected";?>>Principales</option>
            <option type="number" value="3" <?php if($producto->getNombre_categoria() == "Pizzas") echo "Selected";?>>Pizzas</option>
            <option type="number" value="4" <?php if($producto->getNombre_categoria() == "Mariscos") echo "Selected";?>>Mariscos</option>
            <option type="number" value="5" <?php if($producto->getNombre_categoria() == "Postres") echo "Selected";?>>Postres</option>
            <option type="number" value="6" <?php if($producto->getNombre_categoria() == "Sandwiches") echo "Selected";?>>Sandwiches</option>
            <option type="number" value="7" <?php if($producto->getNombre_categoria() == "Bebidas") echo "Selected";?>>Bebidas</option>
        </select>
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" value="<?=$producto->getFoto()?>" accept="image/"><br><br>
        </br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>
    </div>

</body>
</html>

