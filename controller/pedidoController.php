<?php
include_once 'model/Principal.php';
include_once 'model/Entrante.php';
include_once 'model/ProductoDAO.php';

// Creamos el controlador de pedidos

class productoController{
    public function index(){

        //cabecera

        //panel

        $productos = ProductoDAO::getAllProducts();
        if(!empty($productos)){
            echo '<h2>Todos los productos</h2>';
            echo '<table border="1">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Nombre</th>';
            echo '<th>Precio</th>';
            echo '<th>Categoria</th>';
            echo '</tr>';
            foreach ($productos as $producto){
                echo '<tr>';
                echo '<td>'.$producto['ID'].'</td>';
                echo '<td>'.$producto['nombre'].'</td>';
                echo '<td>'.$producto['precio'].'€</td>';
                echo '<td>'.$producto['nombre_categoria'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }else{
            echo "No se han encontrado datos";
        }
        //fotter
    
    }

    public function compra(){
        echo 'Pagina principal compra';
    }
}
?>