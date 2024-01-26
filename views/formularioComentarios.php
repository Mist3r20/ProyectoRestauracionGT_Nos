<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/comentariosForm_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
    <title>Añadir Comentarios</title>
</head>
<body>
    
    <div class="container pb-4 pt-4">
        <div class="seccionesMAX1">
        <h1>Añadir nuevo Comentario</h1>
        <form id="ComentsForm">
            <label for="comentario">Comentario:</label><br>
            <textarea id="comentario" name="comentario" required></textarea>

            <label for="puntuacion">Puntuación:</label>
            <div class="rating ubicacion" id="puntuacion">
                <input value="5" name="rate" id="star5" type="radio">
                <label title="text" for="star5"></label>
                <input value="4" name="rate" id="star4" type="radio">
                <label title="text" for="star4"></label>
                <input value="3" name="rate" id="star3" type="radio">
                <label title="text" for="star3"></label>
                <input value="2" name="rate" id="star2" type="radio">
                <label title="text" for="star2"></label>
                <input value="1" name="rate" id="star1" type="radio">
                <label title="text" for="star1"></label>
            </div>
            <input type="hidden" id="idPedido" value=<?=$id_pedido?>>
            <button type="submit">Enviar</button>
        </form>
        </div>
    </div>
    <script src="../assets/js/FormularioComentarios.js"></script>
    <script src="https://unpkg.com/notie"></script>
</body>
</html>