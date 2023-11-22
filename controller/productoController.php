<?php
include_once 'model/Bebidas.php';
include_once 'model/Mariscos.php';
include_once 'model/Pizzas.php';
include_once 'model/Postres.php';
include_once 'model/Sandwiches.php';
include_once 'model/Principal.php';
include_once 'model/Entrantes.php';
include_once 'model/ProductoDAO.php';
include_once 'model/Pedido.php';
include_once 'utils/CalculadoraPrecio.php';

// Creamos el controlador de pedidos

class productoController{
    public function index(){


        //Creamos e iniciamos una session
        session_start();

        if(!isset($_SESSION['selecciones'])){
            $_SESSION['selecciones'] = array();
        }else{

            if($_POST['ID']){
                $pedido = new Pedido(ProductoDAO::getProductById($_POST['ID']));
                array_push($_SESSION['selecciones'], $pedido);
            }

        }


        var_dump($_SESSION['selecciones']);
    
        
        $allProducts = ProductoDAO::getAllProductsType("Entrantes");
        //cabecera
        include 'views/cabecera.php';
        //panel
        include_once 'views/panelPedidos.php';
        //fotter
        //include_once 'views/footer.php';
    
    }

    public function compra(){
        session_start();

        if(isset($_POST['Add'])){
            $pedido = $_SESSION['selecciones'][$_POST['Add']];
            $pedido->setCantidad($pedido->getCantidad()+1);
            echo 'Añades otro producto a '.$_POST['Add'];
        }else if(isset($_POST['Del'])){

            $pedido = $_SESSION['selecciones'][$_POST['Del']];
            if($pedido->getCantidad() == 1){
                unset($_SESSION['selecciones'][$_POST['Del']]);
                $_SESSION['selecciones'] = array_values($_SESSION['selecciones']);
            }else{
                $pedido->setCantidad($pedido->getCantidad()-1);
            }
            
            echo 'Eliminar 1 producto a '-$_POST['Del'];
        }
        //cabecera
        include 'views/cabecera.php';
        //panel
        include_once 'views/panelCompra.php';

    }

    public function eliminar(){
        //echo "Producto a eliminar";
        if(isset($_POST['ID'])){
        //Falta IF
            $id_product = $_POST['ID'];
            ProductoDAO::deleteProduct($id_product);
        }
        
        header("Location:".url.'?controller=producto');
    }
    
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
    
}
?>
