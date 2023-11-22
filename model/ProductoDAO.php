<?php
include_once 'config/DataBase.php';
include_once 'model/Bebidas.php';
include_once 'model/Mariscos.php';
include_once 'model/Pizzas.php';
include_once 'model/Postres.php';
include_once 'model/Sandwiches.php';
include_once 'model/Principal.php';
include_once 'model/Entrantes.php';

class ProductoDAO{
    
    public static function getAllProductsType($tipo){
        $con = DataBase::connect();
        //EJEMPLO
        $query = "SELECT productos.ID, productos.Nombre, productos.precio, productos.descripcion, productos.foto, categoria.nombreCategoria 
        FROM productos 
        JOIN categoria ON productos.ID_categoria = categoria.ID WHERE categoria.nombreCategoria = ?;";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $tipo);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_object($tipo)){
            $productos[] = $row;
        }
        return $productos;
    }

    
    public static function getAllProducts(){
        $con = DataBase::connect();
        
        $query = "SELECT productos.ID, productos.Nombre, productos.precio, productos.descripcion, productos.foto, categoria.nombreCategoria 
        FROM productos 
        JOIN categoria ON productos.ID_categoria = categoria.ID";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_object('')){
            $allproductos[] = $row;
        }
        return $allproductos;
    }

    public static function getProductById($id){
        $con = DataBase::connect();
        
        $query = "SELECT categoria.nombreCategoria FROM productos JOIN categoria ON productos.ID_categoria = categoria.ID WHERE productos.ID = ?;";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $tipo=$stmt->get_result()->fetch_object()->nombreCategoria;


        //Hay que hacer otra select para coger el ID_categoria del producto para sacar posteriormente el nombre 
        //de la categoria para usarla en el fetch_object de despues
        $stmt=$con->prepare("SELECT productos.ID, productos.Nombre, productos.precio, productos.descripcion, productos.foto, categoria.nombreCategoria 
        FROM productos 
        JOIN categoria ON productos.ID_categoria = categoria.ID WHERE productos.ID = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result=$stmt->get_result();
        $con->close();


        $producto = $result->fetch_object($tipo);
        
        
        return $producto;
        
    }

    //Creamos funcion para recoger los valores de la tabla Categorias 
    public static function getCategorias(){
        $con = DataBase::connect();
        $query = "SELECT * FROM categoria";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();

        return $result;
    }

    public static function deleteProduct($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM productos WHERE ID=?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public static function updateProduct($id, $nombre, $precio,  $descripcion, $IDCategoria, $foto){ 
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE productos SET nombre= ?, precio=?, descripcion=?, ID_categoria =? WHERE ID=?");
        //FALTA AÑADIR LOS PARAMETROS SUFICIENTES PARA UPDATE DE FOTO 
        $stmt->bind_param("sdsii", $nombre, $precio, $descripcion, $IDCategoria, $id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
?>