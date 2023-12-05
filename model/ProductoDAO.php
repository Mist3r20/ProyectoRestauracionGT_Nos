<?php
include_once 'config/DataBase.php';
include_once 'model/Bebidas.php';
include_once 'model/Mariscos.php';
include_once 'model/Pizzas.php';
include_once 'model/Postres.php';
include_once 'model/Sandwiches.php';
include_once 'model/Principales.php';
include_once 'model/Entrantes.php';
include_once 'model/Comentario.php';

//Clase que tratara todas las funciones que usaran consultas SQL para tratar con el servidor
class ProductoDAO{

    //Funcion que buscara en la base de datos todos los productos que sean de una misma categoria
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
        $productos = [];
        while($row = $result->fetch_object($tipo)){
            $productos[] = $row;
        }
        return $productos;
    }

    //Funcion que buscara en la base de datos todos los productos de la base de datos
    public static function getAllProducts(){
        $con = DataBase::connect();
        
        $allproductos = array_merge(ProductoDAO::getAllProductsType('Entrantes'),ProductoDAO::getAllProductsType('Principales'),ProductoDAO::getAllProductsType('Pizzas'), ProductoDAO::getAllProductsType('Sandwiches'),ProductoDAO::getAllProductsType('Mariscos'), ProductoDAO::getAllProductsType('Postres'),ProductoDAO::getAllProductsType('Bebidas'));
        
        return $allproductos;
    }

    //Funcion que buscara en la base de datos solo un unico producto recogiendo el ID de este
    public static function getProductById($id){
        $con = DataBase::connect();
        
        $query = "SELECT categoria.nombreCategoria FROM productos JOIN categoria ON productos.ID_categoria = categoria.ID WHERE productos.ID = ?;";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $tipo=$stmt->get_result()->fetch_object()->nombreCategoria;


        
        $stmt=$con->prepare("SELECT productos.ID, productos.Nombre, productos.precio, productos.descripcion, productos.foto
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

    //Funcion para eliminar un producto mediante la ID
    public static function deleteProduct($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM productos WHERE ID=?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    
    //Funcion para editar un producto 
    public static function updateProduct($id, $nombre, $precio,  $descripcion, $IDCategoria, $foto){ 
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE productos SET nombre= ?, precio=?, descripcion=?, ID_categoria =? WHERE ID=?");
        //FALTA AÑADIR LOS PARAMETROS SUFICIENTES PARA UPDATE DE FOTO 
        $stmt->bind_param("sdsii", $nombre, $precio, $descripcion, $IDCategoria, $id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    //Funcion para recoger productos de la base de datos que seran las novedades
    public static function getProductsNovedad(){
        $tipo = 'Pizzas';
        $con = DataBase::connect();
        //EJEMPLO
        $query = "SELECT productos.ID, productos.Nombre, productos.precio, productos.descripcion, productos.foto, categoria.nombreCategoria 
        FROM productos 
        JOIN categoria ON productos.ID_categoria = categoria.ID WHERE categoria.nombreCategoria = ?;";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $tipo);
        $stmt->execute();
        $result = $stmt->get_result();
        $productosNov = [];
        while($row = $result->fetch_object($tipo)){
            $productosNov[] = $row;
        }
        return $productosNov;
    }

    //Funcion que cogera los comentarios de la pagina principal
    public static function getComentariosPrincipal(){
        
        $con = DataBase::connect();
        //EJEMPLO
        $query = "SELECT comentarios.ID, comentarios.ID_usuario, comentarios.calificacion, comentarios.texto FROM comentarios";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $comentario = [];
        while($row = $result->fetch_object('Comentario')){
            $comentario[] = $row;
        }
        return $comentario;
    }

    
}
?>