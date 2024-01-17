<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/home_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
   
    
</head>
<body>
  <!--Menu-->
  <div class="container">
      <div class="menu">
      <ul class="nav nav-pills custom-nav">
            <li class="custom-nav-item">
              <a href="<?=url."?controller=producto&action=carta&categoria=Entrantes"?>">
                <img src="../assets/icons/canapes.png" alt="Icono de canapes enlace a entrantes " class="custom-image">
                <span class="custom-text">Entrantes</span>
              </a>
            </li>
            <li class="custom-nav-item">
              <a href="<?=url."?controller=producto&action=carta&categoria=Principales"?>">
                <img src="../assets/icons/plato-principal.png" alt="Icono plato principal enlace platos principales" class="custom-image">
                  <span class="custom-text">Principales</span>
              </a>
            </li>
            <li class="custom-nav-item">
              <a href="<?=url."?controller=producto&action=carta&categoria=Pizzas"?>">
                <img src="../assets/icons/pizza.png" alt="Icono pizza enlace a pizzas" class="custom-image">
                <span class="custom-text">Pizzas</span>
              </a>
            </li>
            <li class="custom-nav-item">
              <a href="<?=url."?controller=producto&action=carta&categoria=Sandwiches"?>">
                <img src="../assets/icons/sandwich.png" alt="Icono sandwich enlace a Sandwiches " class="custom-image">
                <span class="custom-text">Sandwiches</span>
              </a>
            </li>
            <li class="custom-nav-item">
              <a href="<?=url."?controller=producto&action=carta&categoria=Mariscos"?>">
                <img src="../assets/icons/camaron.png" alt="Icono Camaron enlace a Mariscos " class="custom-image">
                <span class="custom-text">Mariscos</span>
              </a>
            </li>
            <li class="custom-nav-item">
              <a href="<?=url."?controller=producto&action=carta&categoria=Postres"?>">
                <img src="../assets/icons/pastel.png" alt="Icono sandwich enlace a Sandwiches " class="custom-image">
                <span class="custom-text">Postres</span>
              </a>
            </li>
            <li class="custom-nav-item">
              <a href="<?=url."?controller=producto&action=carta&categoria=Bebidas"?>">
                <img src="../assets/icons/jugo.png" alt="Icono sandwich enlace a Sandwiches " class="custom-image">
                <span class="custom-text">Bebidas</span>
              </a>
            </li>
          </ul>
      </div>
  </div>
  <!--Seccion 1-->
  <div class="container mb-30">
    <section class="seccionesMAX1">
      <h2 class="titulo-seccion1">Categorías destacadas</h2> 
      <div class="row ">
        <div class="col-12 col-lg-3 mb-2 ps-md-0 pe-md-1">
          <article class="large-article article1">
            <div class="content ml-2">
              <h3>Lo mejor</h3>
              <h3>es empezar</h3>
              <p>Categoria <span>TOP</span></p>
              <p>desde <span>1,50€</span></p>
              <div class="text-left mt-2">
                <a href="<?=url."?controller=producto&action=carta"?>" class="redirect-button">VER MÁS</a>
              </div>
            </div>
          </article>
        </div>
        <div class="col-12 col-lg-3 px-md-1">
          <article class="small-article mb-2 article2">
            <div class="content ml-2">
              <h3>SABOR</h3>
              <p>Croquetas de <span>jamón</span></p>
              <p>desde <span>4,99€</span></p>
              <div class="text-left mt-2">
                <a href="<?=url."?controller=producto&action=carta"?>" class="redirect-button">VER MÁS</a>
              </div>
            </div>
          </article>
          <article class="small-article article3 mb-2 px-md-1">
            <div class="content ml-2">
              <h3>Pizzas Design</h3>
              <p>Transforma tu pizza</p>
              <div class="text-left mt-2">
                <a href="<?=url."?controller=producto&action=carta"?>" class="redirect-button">VER MÁS</a>
              </div>
            </div>
          </article>
        </div>
        <div class="col-12 col-lg-3 mb-2 px-md-1">
          <article class="large-article article4">
            <div class="content ml-2">
              <h3>ENTREGAS RAPIDAS</h3>
              <p>Platos recien hechos</p>
              <div class="text-left mt-2">
                <a href="<?=url."?controller=producto&action=carta"?>" class="redirect-button">VER MÁS</a>
              </div>
            </div>
          </article>
        </div>
        <div class="col-12 col-lg-3 ps-md-1 pe-md-0">
          <article class="small-article mb-2 article5">
            <div class="content ml-2">
              <h3>CREPES</h3>
              <p>desde <span>6,99€</span></p>
              <div class="text-left mt-2">
                <a href="<?=url."?controller=producto&action=carta"?>" class="redirect-button">VER MÁS</a>
              </div>
            </div>
          </article>
          <article class="small-article article6">
            <div class="content ml-2">
              <h3>La mejor</h3>
              <h3>calidad precio</h3>
              <p>desde <span>4,49€</span></p>
              <div class="text-left mt-2">
                <a href="<?=url."?controller=producto&action=carta"?>" class="redirect-button">VER MÁS</a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>
  </div>
  <!--Seccion 2-->
  <div class="container fondo-seccion2">
    <section class="seccionesMAX2">
      <div class="row">
        <div class="col-lg-8 mt-20">
          <h2 class="titulo-seccion2">Descubre nuestras novedades</h2>
        </div>
        <div class="col-lg-4 mb-2 d-flex align-items-center justify-content-end mt-20">
          <a href="<?=url."?controller=producto&action=carta"?>" class="section-button">VER TODOS</a>
        </div>
      </div>
      <div class="row pb-30 mt-20">
        <?php
  
        $productosNov = ProductoDAO::getProductsNovedad();  
        foreach($productosNov as $producto){?>
        <div class="col-12 col-lg-3 mb-2">
          <article class="card mx-2 mx-md-0">
            <img src="data:image/jpeg; base64,<?=base64_encode($producto->getFoto())?>" alt="<?=$producto->getDescripcion()?>" class="card-image"/>
            <div class="card-content text-center">
              <h3 class="card-title"><?=$producto->getNombre()?></h3>
              <p class="card-text">Desde <?=$producto->getPrecio()?>€</p>
              <form action=<?="?controller=producto&action=sel&pg=index"?> method="POST">
                <input name="ID" value=<?=$producto->getID()?> hidden>
                <button class="card-button">COMPRAR</button>
              </form>
            </div>
          </article>
        </div>
        <?php }?>
      </div>
    </section>
  </div>
  <!--Seccion 3-->
  <div class="container">
    <div class="seccionesMAX1">
      <div class="row">
        <p class="titulo-seccion3 mt-20">Opiniones de nuestros clientes</p>
        
      </div>
      <div class="row pb-20 pt-30">
        <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center">
          <div class="comment text-center">
            <h4 class="text-center">BUENO</h4>
            <div class="rating">
              <span class="star">&#9733;</span>
              <span class="star">&#9733;</span>
              <span class="star">&#9733;</span>
              <span class="star">&#9733;</span>
              <span class="star-empty">&#9733;</span>
            </div>
            <p class="text-center">Basado en 4980 Valoraciones. Lea algunas de las opiniones aquí.</p>
            <img src="/assets/images/ekomi-logo-2.png">
          </div>
        </div>
        <!--Comentario 1-->
        <?php $comentarios = ComentariosDAO::getComentariosPrincipal();
          foreach($comentarios as $comentario){
        ?>
        <div class="col-12 col-lg-2">
          <div id="commentCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active text-center">
                <div class="rating">
                  <?php $cali = $comentario->getEstrellas();
                   for($i = 1; $i<=5; $i++){
                      if($i<=$cali){?>
                        <span class="star">&#9733;</span>
                      <?php } else{ ?>  
                        <span class="star-empty">&#9733;</span>
                      <?php }
                    }
                  ?>
                </div>
                <p class="review-text"><?= $comentario->getTexto()?></p>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <a href="<?=url."?controller=comentarios&action=comentarios"?>" class="section-button">VER MÁS COMENTARIOS</a>
      </div>
      <?=$cookie?>
    </div>
  </div>
  <!--Seccion 4 / Banner-->
  <div class="container fondo-seccion2">
    <div class="seccionesMAX1 row espacio-banner">
      <div class="col-md-12 p-0">
        <a href="<?=url."?controller=producto&action=carta"?>">
          <img class="enlace-banner" src="/assets/images/Banner.png" alt=""/>
        </a>
      </div>
    </div>
  </div>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>