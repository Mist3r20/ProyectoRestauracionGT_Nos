<?php
include_once 'model/Principal.php';
include_once 'model/Entrantes.php';
include_once 'model/ProductoDAO.php';

// Creamos el controlador de pedidos

class productoController{
    public function index(){

        
        $allProducts = ProductoDAO::getAllProductsType("Entrantes");
        //cabecera
        include_once 'views/cabecera.php';
        //panel
        include_once 'views/panelPedidos.php';
        //fotter
    
    }

    public function compra(){
        echo 'Pagina principal compra';
    }

    public function eliminar(){
        //echo "Producto a eliminar";

        //Falta IF
        echo $_POST['ID'];
        $id_product = $_POST['ID'];
        //ProductoDAO::deleteProduct($id_product);
        //header("Location:".url.'?controller=producto');
    }
    
    public function editar(){
            echo 'Actualizar producto';
            $id_producto=$_POST['id'];
            $producto = ProductoDAO::getProductById($id_producto);

            include_once 'views/editarPedido.php';
    }

    public function actualizar(){
        echo 'Actualizar producto';
        $id = $_POST[''];
        $nombre = $_POST['nombre'];
        $id = $_POST[''];
        $id = $_POST[''];

        //ProductoDAO::updateProduct($id, $nombre, );
        //header("Location:".url.'?controller=producto');
    }

    
}
?>
