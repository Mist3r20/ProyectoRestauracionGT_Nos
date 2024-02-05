<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/comentarios_estil.css" rel="stylesheet" type="text/css" media="screen">
    
    
    <title>Comentarios</title>
</head>
<body>
    

    <div class="container">
        <div class="seccionesMAX1">
            <h1 class="tituloComentarios">Comentarios</h1>
            <label for="orden">Orden:</label>
            <select id="orden">
                <option>Selecciona el orden</option>
                <option value="ascendente">Ascendente</option>
                <option value="descendente">Descendente</option>
            </select><br>

            <label>Filtrar por Puntuación:</label>
            <div id="checkboxes">
                <label><input type="checkbox" class="filtro-puntuacion" value="0"> 0</label>
                <label><input type="checkbox" class="filtro-puntuacion" value="1"> 1</label>
                <label><input type="checkbox" class="filtro-puntuacion" value="2"> 2</label>
                <label><input type="checkbox" class="filtro-puntuacion" value="3"> 3</label>
                <label><input type="checkbox" class="filtro-puntuacion" value="4"> 4</label>
                <label><input type="checkbox" class="filtro-puntuacion" value="5"> 5</label>
            </div>
            
            <div class="row mt-4">
                <div class="reseñas-pagina row">
                    
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/Comentarios.js"></script>
</body>
</html>