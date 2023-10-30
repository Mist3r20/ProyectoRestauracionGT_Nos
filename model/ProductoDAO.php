<?php
include_once 'config/DataBase.php';
include_once 'Entrantes.php';
include_once 'Principal.php';

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
        $tipo=$stmt->get_result()->fetch_object()->tipo;


        //Hay que hacer otra select para coger el ID_categoria del producto para sacar posteriormente el nombre 
        //de la categoria para usarla en el fetch_object de despues
        $stmt=$con->prepare("SELECT productos.ID, productos.nombre, productos.precio, productos.descripcion, productos.foto, categoria.nombreCategoria 
        FROM productos 
        JOIN categoria ON productos.ID_categoria = categoria.ID WHERE productos.ID = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result=$stmt->get_result();
        $con->close();


        $producto = $result->fetch_object($tipo);
        
        
        return $producto;
        
    }

    public static function deleteProduct($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM productos WHERE ID=?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public static function updateProduct($ID, $Nombre, $precio,  $descripcion, $nombreCategoria, $foto){ //AÑADIR LAS VARIABLES QUE PEDIRA PARA ACTUALIZR EL PRODUCTO
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE productos SET nombre= ?, =?, =? WHERE ID=?");
        $stmt->bind_param("sdsi", $nombre, );

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
?>