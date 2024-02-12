<?php
include_once 'model/Bebidas.php';
include_once 'model/Mariscos.php';
include_once 'model/Pizzas.php';
include_once 'model/Postres.php';
include_once 'model/Sandwiches.php';
include_once 'model/Principales.php';
include_once 'model/Entrantes.php';
include_once 'model/ProductoDAO.php';
include_once 'model/Pedido.php';
include_once 'utils/CalculadoraPrecio.php';
include_once 'model/Comentario.php';

//Realizamos include de este archivo para comprobar si esta iniciada o no la session
include 'utils/session_init.php';

// Creamos el controlador de pedidos

class productoController
{

    //Funcion index la cual recogera la pagina HOME de la pagina 
    public function index()
    {
        $nombre = "Pagina Principal";

        // Verificar si $_SESSION['selecciones'] tiene elementos
        $tieneElementos = !empty($_SESSION['selecciones']);

        //cabecera
        include 'views/header.php';

        //Realizamos comprobacion del rol del usuario para poder mostrar despues un tipo u otro de boton en la pagina de carrito
        if (isset($_COOKIE['Ultimopedido']) && isset($_SESSION['ID']) && $_SESSION['ID'] == $_COOKIE['ID']) {
            $cookie = '<form action="?controller=producto&action=carrito&recuperar=true" method="POST">
            <button class="redirect-button">RECUPERAR ULTIMO PEDIDO</button>
            </form>';
        } else {
            $cookie = '';
        }
        //panel
        include_once 'views/home.php';

        //creamos cookie

        if (isset($_COOKIE['Ultimopedido'])) {
            $datos_cookie = $_COOKIE['Ultimopedido'];
        }
        // setcookie("Ultimopedido",'',time()-3600);
        //fotter
        include_once 'views/footer.php';
    }




    //Funcion que mostrara la carta de la pagina web con los productos que se deseen ver
    public function carta()
    {
        $nombre = "Carta";

        //comprobamos la categoria seleccionada en el select de la pagina, o del submenu de las paginas, sino se ha seleccionada niguna categoria
        //mostrara todos los productos
        if (isset($_POST['categoriaSelect'])) {
            $categoria = $_POST['categoriaSelect'];
            //si el valor es todos motrara todos los productos, sino mostrara los productos de una misma categoria seleccionada
            if ($categoria === 'Todos') {
                $allProducts = ProductoDAO::getAllProducts();
            } else {
                $allProducts = ProductoDAO::getAllProductsType($categoria);
            }
        } elseif (isset($_GET['categoria'])) {
            $categoria = $_GET['categoria'];
            $allProducts = ProductoDAO::getAllProductsType($categoria);
        } else {
            $allProducts = ProductoDAO::getAllProducts();
            $categoria = 'Todas categorias';
        }


        // Verificar si $_SESSION['selecciones'] tiene elementos
        $tieneElementos = !empty($_SESSION['selecciones']);

        //cabecera
        include_once 'views/header.php';

        //panel
        include_once 'views/carta.php';

        //footer
        include_once 'views/footer.php';
    }

    //funcion que contiene el carrito de la pagina web
    public function carrito()
    {
        $nombre = "Carrito";


        if (isset($_GET['recuperar'])) {
            $recuperar = ProductoDAO::getProductoByPedido($_COOKIE['Ultimopedido']);
            $_SESSION['selecciones'] = $recuperar;
        }


        if (isset($_POST['Add'])) {
            //Añadimos producto
            $pedido = $_SESSION['selecciones'][$_POST['Add']];
            $pedido->setCantidad($pedido->getCantidad() + 1);
        } else if (isset($_POST['Del'])) {

            $pedido = $_SESSION['selecciones'][$_POST['Del']];
            if ($pedido->getCantidad() == 1) {
                unset($_SESSION['selecciones'][$_POST['Del']]);
                //Re-Indexamos el Array selecciones
                $_SESSION['selecciones'] = array_values($_SESSION['selecciones']);
            } else {
                $pedido->setCantidad($pedido->getCantidad() - 1);
            }
        }
        if (isset($_POST['eliminar'])) {
            unset($_SESSION['selecciones'][$_POST['eliminar']]);
            //Re-Indexamos el Array selecciones
            $_SESSION['selecciones'] = array_values($_SESSION['selecciones']);
        }

        if (count($_SESSION['selecciones']) == 0) {
            header("Location:" . url . '?controller=producto&action=index');
        }

        //header
        include_once 'views/header.php';

        //carrito
        include_once 'views/carrito.php';
        //footer
        include_once 'views/footer.php';
    }


    //Funcion sel la cual sera la encargada de añadir el producto a la array de session
    public function sel()
    {


        if (isset($_POST['ID'])) {
            $productoId = $_POST['ID'];
            $encontrado = false;

            // Recorremos los productos en el carrito para verificar si ya está presente
            foreach ($_SESSION['selecciones'] as $pedido) {
                if ($pedido->getProducto()->getID() == $productoId) {
                    $encontrado = true;
                    // Si ya está en el carrito, incrementamos la cantidad
                    $pedido->setCantidad($pedido->getCantidad() + 1);
                    break;
                }
            }

            // Si no se encontró, agregamos el producto al carrito con cantidad = 1
            if (!$encontrado) {
                $pedido = new Pedido(ProductoDAO::getProductById($productoId));
                $pedido->setCantidad(1);
                array_push($_SESSION['selecciones'], $pedido);
            }

            // Redirección después de manejar la lógica del carrito
            if (isset($_GET['pg'])) {
                $redireccion = $_GET['pg'];
                if ($redireccion == "index") {
                    header("Location:" . url . '?controller=producto&action=index');
                } else {
                    header("Location:" . url . '?controller=producto&action=carta');
                }
            } else {
                header("Location:" . url . '?controller=producto&action=index');
            }
        }
    }

    //funcion que se usara para eliminar un producto con el id
    public function eliminar()
    {
        //echo "Producto a eliminar";
        if (isset($_POST['ID'])) {
            //Falta IF
            $id_product = $_POST['ID'];
            ProductoDAO::deleteProduct($id_product);
        }

        header("Location:" . url . '?controller=producto&action=carta');
    }

    //funcion para editar un producto
    public function editar()
    {
        $nombre = "Editar Pedido";
        if (isset($_POST['ID'])) {
            $id_producto = $_POST['ID'];
            $producto = ProductoDAO::getProductById($id_producto);
            $categorias = ProductoDAO::getCategorias();

            include_once 'views/editarPedido.php';
        } else {
            echo 'ERROR AL PASAR EL ID';
        }
    }

    //function que recoge y pasa los valores del producto a actualizar y los manda a updateProduct en ProductoDAO
    public function actualizar()
    {
        if (isset($_POST['id_producto']) && isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['descripcion'])) {
            $id = $_POST['id_producto'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $IDCategoria = $_POST['IDCategoria'];
            $foto = $_POST['imagen'];

            ProductoDAO::updateProduct($id, $nombre, $precio,  $descripcion, $IDCategoria, $foto);
        }
        header("Location:" . url . '?controller=producto&action=carta');
    }

    //funcion para crear un producto nuevo
    public function crear()
    {

        $categorias = ProductoDAO::getCategorias();
        //views
        include_once "views/crearProducto.php";
    }


    //funcion que recibira los datos para añadir nuevo producto a la BBDD
    public function añadirBBDD()
    {
        if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['descripcion']) && isset($_POST['IDCategoria'])) {
            if (isset($_POST['IDCategoria']) == 7 && isset($_POST['ml'])) {
                $nombre = $_POST['nombre'];
                $precio = $_POST['precio'];
                $descripcion = $_POST['descripcion'];
                $ml = $_POST['ml'];
                $IDCategoria = $_POST['IDCategoria'];
                $foto = $_POST['imagen'];

                //Enviamos los datos para poder insertarlo en la BBDD
                ProductoDAO::insertProduct($nombre, $precio,  $descripcion, $ml, $IDCategoria, $foto);
            } else {
                $nombre = $_POST['nombre'];
                $precio = $_POST['precio'];
                $descripcion = $_POST['descripcion'];
                $ml = NULL;
                $IDCategoria = $_POST['IDCategoria'];
                $foto = $_POST['imagen'];
                //Enviamos los datos para poder insertarlo en la BBDD pero si no es una bebida
                ProductoDAO::insertProduct($nombre, $precio,  $descripcion, $ml, $IDCategoria, $foto);
            }
        }
        header("Location:" . url . '?controller=producto&action=carta');
    }

    // Función confirmar: esta función se encarga de confirmar y finalizar un pedido.
    public function confirmar()
    {
        // Se obtiene el ID de usuario de la sesión actual.
        $ID_user = $_SESSION['ID'];

        // Se crea un objeto DateTime con la fecha y hora actuales.
        $fecha = new DateTime();

        // Se convierte la fecha a un formato adecuado para SQL (YYYY-MM-DD).
        $fechaSQL = $fecha->format('Y-m-d');

        // Se verifica si el estado del pedido es "finalizado" y si hay una sesión de usuario activa.
        if (isset($_GET['estado']) && $_GET['estado'] == "finalizado" && isset($_SESSION['ID'])) {

            // Se obtiene el estado del pedido.
            $estado = $_GET['estado'];

            // Se obtienen los puntos disponibles del usuario actual.
            $puntosActuales = UsuarioDAO::obtenerPuntosDisponiblesUsuario($_SESSION['ID']);

            // Tasa de puntos para el descuento (0.5 indica la mitad del valor del pedido en puntos).
            $tasaPuntos = 0.5;

            // Se verifica si se ha enviado el precio con descuento a través de POST.
            if (isset($_POST['precioConDescuento'])) {
                $total = $_POST['precioConDescuento'];
            }

            // Se verifica si se ha aplicado el descuento (valor 1 indica que se ha aplicado).
            if (isset($_POST['descuentoAplicado']) && intval($_POST['descuentoAplicado']) >= 1) {
                $puntosAplicados = intval($_POST['descuentoAplicado']);
                // Se calculan los nuevos puntos con descuento aplicado.
                $ganarPuntos = round($total * $tasaPuntos);
                $puntosActuales -= $puntosAplicados;

                $nuevosPuntos = $puntosActuales + $ganarPuntos;
            } else {
                // Se calculan los puntos a agregar sin descuento aplicado.
                $puntosAgregar = round($total * $tasaPuntos);
                $nuevosPuntos = $puntosActuales + $puntosAgregar;
                $puntosAplicados = 0;
            }

            if (isset($_POST['propinaAplicada'])) {
                $propina = $_POST['propinaAplicada'];
            } else {
                $propina = 0;
            }

            if (isset($_POST['porcentajeAplicado'])) {
                $porcentaje = $_POST['porcentajeAplicado'];
            } else {
                $porcentaje = 0;
            }


            // Se actualizan los puntos del usuario en la base de datos.
            UsuarioDAO::actualizarPuntos($_SESSION['ID'], $nuevosPuntos);

            // Se finaliza el pedido y se obtiene el ID del último pedido insertado en la base de datos.
            $UltimoInsertID = ProductoDAO::finalizarPedido($ID_user, $fechaSQL, $estado, $_SESSION['selecciones'], $total, $puntosAplicados, $propina, $porcentaje);

            // Se guardan cookies con información del último pedido y el ID del usuario.
            setcookie("Ultimopedido", $UltimoInsertID, time() + 3600);
            setcookie("ID", $_SESSION['ID'], time() + 3600);

            unset($_SESSION['selecciones']);

            header("Location:" . url . '?controller=producto');
        } else {
            // Si no se cumple alguna de las condiciones, se redirige a la página de inicio de sesión.
            header("Location:" . url . '?controller=usuario&action=session');
        }
    }


    public function VerDetallesPedido()
    {
        $nombre = "Detalle del Pedido";
        if (isset($_POST['ver'])) {
            $recuperar = ProductoDAO::getProductoByPedido($_POST['ver']);
        } else {
            header("Location:" . url . '?controller=usuario&action=pedidos');
        }

        include_once 'views/header.php';
        include_once 'views/detallesPedido.php';
        include_once 'views/footer.php';
    }

    public function PaginaDetallesPedidoQR()
    {
        $nombre = "Informacion del Pedido";
        $ID_user = $_SESSION['ID'];

        $pedidos = ProductoDAO::getUltimoPedidoByUser($ID_user);

        $productos = ProductoDAO::getProductoByPedido($pedidos);

        // Obtener solo el primer elemento del array
        $primerPedido = reset($productos);

        // Verificar si hay algún pedido
        if ($primerPedido) {
            $primerPedidoID = $primerPedido->getID();
            $primerPedidoFecha = $primerPedido->getFecha();

            // Ahora puedes utilizar $primerPedidoID y $primerPedidoFecha en tu código PHP
        }

        include_once 'views/header.php';
        include_once 'views/detallesPedidoQR.php';
        include_once 'views/footer.php';
    }
}
