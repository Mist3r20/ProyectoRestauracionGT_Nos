<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/crear_estil.css" rel="stylesheet" type="text/css" media="screen">
    <title>Crear Producto</title>
</head>
<body>
<div class="container">
    <h1 class="titulo-seccion1">Crear Nuevo Producto</h1>
        <form action="<?= "?controller=producto&action=añadirBBDD" ?>" method="POST">
            <input type="text" name="nombre" placeholder="Nombre del producto"/>
            <input type="number" name="precio" placeholder="Precio"/>
            <input type="text" name="descripcion" placeholder="Descripción"/>
            <select name="IDCategoria">
                <option value="1">Entrantes</option>
                <option value="2">Principales</option>
                <option value="3">Pizzas</option>
                <option value="4">Mariscos</option>
                <option value="5">Postres</option>
                <option value="6">Sandwiches</option>
                <option value="7">Bebidas</option>
            </select>
            <input type="file" name="imagen" accept="image/*"/>
            <input type="number" name="ml" placeholder="Cantidad de ml"/>
            <button class="boton-carta" type="submit" name="crear">CREAR PRODUCTO</button>
        </form>
    </div>
</body>
</html>