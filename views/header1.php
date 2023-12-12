<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/header_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
    
    <title>Header</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg color-header">
        <div class="container-fluid seccionesMAX1">
          <a class="navbar-brand" href="<?=url."?controller=producto"?>"><img src="/assets/images/Header/logo_gt.png"/></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="?controller=producto">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=url."?controller=producto&action=carta"?>">Carta</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn" type="submit"><span class="icon search"></span></button>
              <button class="btn" type="menu"><a class="icon usuario" href="<?=url."?controller=usuario&action=session"?>"></a></button>
              <button class="btn" type="menu"><a class="icon comprar <?= $tieneElementos ? 'has-items' : '' ?>" href="<?=url."?controller=producto&action=carrito"?>"></a></button>
            </form>
          </div>
        </div>
      </nav>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>