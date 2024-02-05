<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">

  <title>Carta</title>
</head>

<body>
  <div class="container">
    <!--MENU SUPERIOR-->
    <div class="menu">
      <ul class="nav nav-pills custom-nav">
        <li class="custom-nav-item">
          <a href="<?= url . "?controller=producto&action=carta&categoria=Entrantes" ?>">
            <img src="../assets/icons/canapes.png" alt="Icono de canapes enlace a entrantes " class="custom-image">
            <span class="custom-text">Entrantes</span>
          </a>
        </li>
        <li class="custom-nav-item">
          <a href="<?= url . "?controller=producto&action=carta&categoria=Principales" ?>">
            <img src="../assets/icons/plato-principal.png" alt="Icono plato principal enlace platos principales" class="custom-image">
            <span class="custom-text">Principales</span>
          </a>
        </li>
        <li class="custom-nav-item">
          <a href="<?= url . "?controller=producto&action=carta&categoria=Pizzas" ?>">
            <img src="../assets/icons/pizza.png" alt="Icono pizza enlace a pizzas" class="custom-image">
            <span class="custom-text">Pizzas</span>
          </a>
        </li>
        <li class="custom-nav-item">
          <a href="<?= url . "?controller=producto&action=carta&categoria=Sandwiches" ?>">
            <img src="../assets/icons/sandwich.png" alt="Icono sandwich enlace a Sandwiches " class="custom-image">
            <span class="custom-text">Sandwiches</span>
          </a>
        </li>
        <li class="custom-nav-item">
          <a href="<?= url . "?controller=producto&action=carta&categoria=Mariscos" ?>">
            <img src="../assets/icons/camaron.png" alt="Icono Camaron enlace a Mariscos " class="custom-image">
            <span class="custom-text">Mariscos</span>
          </a>
        </li>
        <li class="custom-nav-item">
          <a href="<?= url . "?controller=producto&action=carta&categoria=Postres" ?>">
            <img src="../assets/icons/pastel.png" alt="Icono sandwich enlace a Sandwiches " class="custom-image">
            <span class="custom-text">Postres</span>
          </a>
        </li>
        <li class="custom-nav-item">
          <a href="<?= url . "?controller=producto&action=carta&categoria=Bebidas" ?>">
            <img src="../assets/icons/jugo.png" alt="Icono sandwich enlace a Sandwiches " class="custom-image">
            <span class="custom-text">Bebidas</span>
          </a>
        </li>
      </ul>
    </div>
    <!--LINK SUPERIOR-->
    <div class="link">
      <div class="seccionesMAX2 alineacion">
        <p><span class="azul">Inicio </span>/<span class="azul"> Carta </span>/<span class="azul"> <?= $categoria ?></span></p>
      </div>
    </div>
    <!--Titulo y subtitulo-->
    <div class="fondo-carta">
      <div class="seccionesMAX1 titulo-carta">
        <h2 class="nombre-composicion">Carta Galerías del Tresillo</h2>
        <span>Entrantes, platos principales, pizzas, sándwiches,... En Galerías del Tresillo tenemos la mejor y la mas extensa carta. Multitud de platos y sobres</span>
        <div class="row">
          <div class="col-12">
            <div class="linea-separatoria"></div>
            <div class="text-left">
              <div class="text-left">
                <form action="<?= url . "?controller=producto&action=carta" ?>" method="POST" id="filterForm">
                  <label class="filtrar">Filtrar por:</label>
                  <select class="formulario-controll" name="categoriaSelect" id="categoriaSelect">
                    <option value="Todos">Todos</option>
                    <option value="Entrantes">Entrantes</option>
                    <option value="Principales">Principales</option>
                    <option value="Pizzas">Pizzas</option>
                    <option value="Sandwiches">Sandwiches</option>
                    <option value="Mariscos">Mariscos</option>
                    <option value="Postres">Postres</option>
                    <option value="Bebidas">Bebidas</option>
                  </select>
                  <button type="submit" value="Enviar" class="section-button">FILTRAR</button>
                </form>
              </div>
            </div>
            <div class="oval-checkboxes">
              <?php
              $categorias = ['Entrantes', 'Principales', 'Pizzas', 'Sandwiches', 'Mariscos', 'Postres', 'Bebidas'];
              foreach ($categorias as $categoria) {
              ?>
                <div class="oval-checkbox">
                  <label><input class="form-check-input categoria-checkbox" type="checkbox" value="<?= $categoria ?>"><?= $categoria ?></label>
                </div>
              <?php
              }
              ?>
            </div>
            <section class="lista-cartas row" id="productosSection">
              <?php
              foreach ($allProducts as $producto) {
              ?>
                <article class="carta col-12 col-lg-3 mb-2 productos" data-categoria="<?= $producto->getNombre_categoria() ?>">
                  <div class="imagen-carta">
                    <img class="imagen" src="data:image/jpeg; base64,<?= base64_encode($producto->getFoto()) ?>" alt="<?= $producto->getDescripcion() ?>">
                  </div>
                  <p class="text-start titulo-producto"><?= $producto->getNombre() ?></p>
                  <div class="contenido">
                    <div class="row">
                      <div class="col-6 mb-2">
                        <div class="row text-start">
                          <div class="col-12">
                            <p class="desde">Desde</p>
                            <p class="precio"><?= $producto->getPrecio() ?>€</p>
                            <p class="iva">IVA no incluido</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-6 d-flex align-items-center">
                        <div class="text-center">
                          <form action="?controller=producto&action=sel&pg=carta" method="POST">
                            <input name="ID" value=<?= $producto->getID() ?> type="hidden">
                            <button class="boton-carta">COMPRAR</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </article>
              <?php } ?>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/FiltroProductos.js"></script>
</body>

</html>