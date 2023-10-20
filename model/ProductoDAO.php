<?php
include_once('config/DataBase.php');

class ProductoDAO{

    public static function getEntrantes(){
        $con = DataBase::connect();
        if($result = $con->query("SELECT * FROM productos WHERE categoria_id= 1")){
            while($row = $result->fetch_array()){
                $entrantes[] = $row;
            }
        }
        return $entrantes;

    }
    public static function getAllProducts(){
        $con = DataBase::connect();
        if($result = $con->query("SELECT productos.*, categoria.nombre AS nombre_categoria
        FROM productos
        INNER JOIN categoria ON productos.ID_categoria = categoria.id;")){
            while($row = $result->fetch_array()){
                $productos[] = $row;
            }
        }
        return $productos;
    }
}
?>