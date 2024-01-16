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
        $query = "SELECT productos.ID, productos.Nombre, productos.precio, productos.descripcion, productos.ml, productos.foto, categoria.nombreCategoria 
        FROM productos 
        JOIN categoria ON productos.ID_categoria = categoria.ID WHERE categoria.nombreCategoria = ?;";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $tipo);
        $stmt->execute();
        $result = $stmt->get_result();
        $productos = [];

        //Comprobamos si el objeto sera una bebida u otro producto 
        if($tipo == 'Bebidas'){
            while($row = $result->fetch_assoc()){
                $productos[] = new Bebidas($row['ID'], $row['Nombre'], $row['precio'],$row['descripcion'], $row['nombreCategoria'], $row['foto'], $row['ml']);
            }
        }else{
            while($row = $result->fetch_object($tipo)){
                $productos[] = $row;
            }
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


        
        $stmt=$con->prepare("SELECT productos.ID, productos.Nombre, productos.precio, productos.descripcion, productos.ml ,productos.foto
        FROM productos 
        JOIN categoria ON productos.ID_categoria = categoria.ID WHERE productos.ID = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result=$stmt->get_result();
        
        //Comprobamos si el objeto sera una bebida u otro producto 
        if($tipo == 'Bebidas'){
            $row = $result->fetch_assoc();
            $producto = new Bebidas($row['ID'], $row['Nombre'], $row['precio'],$row['descripcion'], $tipo, $row['foto'], $row['ml']);
            
        }else{
            $producto = $result->fetch_object($tipo);
        }
        
        $con->close();
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

    //Funcion que hara el insert del producto nuevo creado por el usuario
    public static function insertProduct($nombre, $precio,  $descripcion, $ml, $IDCategoria, $foto){ 
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO productos (nombre, precio, descripcion, ml, ID_categoria, foto) VALUES ('$nombre', '$precio', '$descripcion', '$ml', '$IDCategoria', '$foto')");

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
        $query = "SELECT comentarios.ID, comentarios.ID_usuario, comentarios.calificacion, comentarios.texto, usuarios.nombre as nombre_usuario
        FROM comentarios
        JOIN usuarios ON comentarios.ID_usuario = usuarios.ID;";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $comentario = [];
        while($row = $result->fetch_object('Comentario')){
            $comentario[] = $row;
        }
       
        return $comentario;
    }

    //Esta funcion realizara 
    public static function finalizarPedido($ID_user, $fechaSQL, $estado, $session, $total){
        $con = DataBase::connect();

        $query = "INSERT INTO pedidos (ID_usuario, fecha, estado_pedido, precioTotal) VALUES ('$ID_user', '$fechaSQL', '$estado', '$total')";

        $stmt = $con->prepare($query);
        $stmt->execute();

        //Obtenemos el ID del ultimo registro insertado
        $ultimoInsertID = $con->insert_id;

        //Insertaremos productos en la tabla relacionada con el ID del pedido 
        foreach($session as $producto){
            $cantidad = $producto->getcantidad();
            $id_producto = $producto->getProducto()->getID();

            //Realizamos el INSERT en la tabla de detalles del pedido, el ID del ultimo insert y la info del producto
            $query_producto = "INSERT INTO detalle_pedido (ID_pedido, ID_producto, cantidad) VALUES ('$ultimoInsertID', '$id_producto', '$cantidad')";
            $stmt_producto = $con->prepare($query_producto);
            $stmt_producto->execute();
        }

        //Devolvemos el ID del ultimo insert realizado 
        return $ultimoInsertID;
    }

    //Funcion que recogera los productos que haya en un pedido
    public static function getProductoByPedido($id_pedido){
        $con = DataBase::connect();

        $query = "SELECT detalle_pedido.ID_producto, detalle_pedido.cantidad FROM detalle_pedido WHERE ID_pedido = ?";

        $stmt= $con->prepare($query);
        $stmt->bind_param("i", $id_pedido);
        $stmt->execute();
        $result = $stmt->get_result();
        $detalles_pedido = array();
        while($row = $result->fetch_assoc()){
            //Por cada fila obtenemos los detalles del producto
            $id_producto=$row['ID_producto'];
            $cantidad = $row['cantidad'];

            //Consulta para obtener los datos del producto y ademas el objeto Producto
            $producto_pedido = ProductoDAO::getProductById($id_producto);

            //creamos el objeto pedido con el producto y la cantidad
            $pedido = new Pedido($producto_pedido);
            $pedido->setCantidad($cantidad);

            //Agregamos el objeto Pedido al array de detalles
            $detalles_pedido[]= $pedido;
        }
        
        return $detalles_pedido;

    
    }

    
}
?>