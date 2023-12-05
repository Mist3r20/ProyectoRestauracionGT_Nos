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

// Creamos el controlador de pedidos

class productoController{

    //Funcion index la cual recogera la pagina HOME de la pagina 
    public function index(){


        //Creamos e iniciamos una session
        session_start();

        if(!isset($_SESSION['selecciones'])){
            $_SESSION['selecciones'] = array();
        }
        
    
        
        // Verificar si $_SESSION['selecciones'] tiene elementos
        $tieneElementos = !empty($_SESSION['selecciones']);
    
        //cabecera
        include 'views/header.php';
        //panel
        include_once 'views/home.php';
        if(isset($_COOKIE['UltimoPedido'])){
            echo 'Tu ultimo pedido fue de '.$_COOKIE['UltimoPedido'].'€';
            setcookie("UltimoPedido",'',time()-3600);
        }
        //fotter
        include_once 'views/footer.php';
    
    }


    //Funcion sel la cual sera la encargada de añadir el producto a la array de session
    public function sel(){
        //Creamos e iniciamos una session
        session_start();

        

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
                    header("Location:".url.'?controller=producto&action=index');
                } else {
                    header("Location:".url.'?controller=producto&action=carta');
                }
            }
        }

    
    }

    //Funcion que mostrara la carta de la pagina web con los productos que se deseen ver
    public function carta(){

        //comprobamos la categoria seleccionada en el select de la pagina, o del submenu de las paginas, sino se ha seleccionada niguna categoria
        //mostrara todos los productos
        if(isset($_POST['categoriaSelect'])){
            $categoria = $_POST['categoriaSelect'];
            //si el valor es todos motrara todos los productos, sino mostrara los productos de una misma categoria seleccionada
            if($categoria === 'Todos'){
                $allProducts = ProductoDAO::getAllProducts();
            }else{
                $allProducts = ProductoDAO::getAllProductsType($categoria);
            }
        }elseif(isset($_GET['categoria'])){
            $categoria = $_GET['categoria'];
            $allProducts = ProductoDAO::getAllProductsType($categoria);
        }else{
            $allProducts = ProductoDAO::getAllProducts();
            $categoria = 'Todas categorias';
        }

        session_start();

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
    public function carrito(){

        session_start();
        // Verificar si $_SESSION['selecciones'] tiene elementos
        $tieneElementos = !empty($_SESSION['selecciones']);

        
        if(isset($_POST['Add'])){
            //Añadimos producto
            $pedido = $_SESSION['selecciones'][$_POST['Add']];
            $pedido->setCantidad($pedido->getCantidad()+1);
        }else if(isset($_POST['Del'])){

            $pedido = $_SESSION['selecciones'][$_POST['Del']];
            if($pedido->getCantidad() == 1){
                unset($_SESSION['selecciones'][$_POST['Del']]);
                //Re-Indexamos el Array selecciones
                $_SESSION['selecciones'] = array_values($_SESSION['selecciones']);
            }else{
                $pedido->setCantidad($pedido->getCantidad()-1);
            }
        
        }
        if(isset($_POST['eliminar'])){
            unset($_SESSION['selecciones'][$_POST['eliminar']]);
            //Re-Indexamos el Array selecciones
            $_SESSION['selecciones'] = array_values($_SESSION['selecciones']);
        }

        if(count($_SESSION['selecciones']) == 0){
            header("Location:".url.'?controller=producto&action=index');
        }
        
        //header
        include_once 'views/header.php';
        //carrito
        include_once 'views/carrito.php';
        //footer
        include_once 'views/footer.php';
    }

    //funcion que se usara para eliminar un producto con el id
    public function eliminar(){
        //echo "Producto a eliminar";
        if(isset($_POST['ID'])){
        //Falta IF
            $id_product = $_POST['ID'];
            ProductoDAO::deleteProduct($id_product);
        }
        
        header("Location:".url.'?controller=producto');
    }
    
    //funcion para editar un producto
    public function editar(){
        if(isset($_POST['ID'])){
            $id_producto=$_POST['ID'];
            $producto = ProductoDAO::getProductById($id_producto);
            $categorias = ProductoDAO::getCategorias();

            include_once 'views/editarPedido.php';
        }else{
            echo 'ERROR AL PASAR EL ID';
        }
    }

    //function que recoge y pasa los valores del producto a actualizar y los manda a updateProduct en ProductoDAO
    public function actualizar(){
        if(isset($_POST['id_producto']) && isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['descripcion'])){
            $id = $_POST['id_producto'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $IDCategoria = $_POST['IDCategoria'];
            $foto = $_POST['imagen'];

            ProductoDAO::updateProduct($id, $nombre, $precio,  $descripcion, $IDCategoria, $foto);
            
        }
        header("Location:".url.'?controller=producto');
    }
    
    //Funcion confirmar sera la que suba el pedido uan vez finalizado a la base de datos
    public function confirmar(){
        session_start();
        //Te almacena el pedido en la base de datos Pedido DAO que guarda el pedido en la base de datos
        
        //Guardo la cookie
        setcookie("Ultimo pedido",$_POST['cantidadFinal'],time()+3600);

        //Borramos sesion de pedido
        unset($_SESSION['selecciones']);

        //Redirigimos a la pagina principal
        header("Location:".url.'?controller=producto');
    }
}
?>
