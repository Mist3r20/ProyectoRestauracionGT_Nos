<?php
include_once 'config/DataBase.php';
include_once 'model/Comentario.php';

class ComentariosDAO{

    //Funcion que cogera los comentarios de la pagina principal
    public static function getComentariosPrincipal(){
        
        $con = DataBase::connect();
        //EJEMPLO
        $query = "SELECT comentarios.ID, comentarios.ID_usuario, comentarios.calificacion, comentarios.texto, usuarios.nombre as nombre_usuario
        FROM comentarios
        JOIN usuarios ON comentarios.ID_usuario = usuarios.ID ORDER BY comentarios.ID ASC
        LIMIT 4";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $comentario = [];
        while($row = $result->fetch_object('Comentario')){
            $comentario[] = $row;       
        }
       
        return $comentario;
    }

    public static function getComentarios(){
        
        $con = DataBase::connect();
        //EJEMPLO
        $query = "SELECT comentarios.ID, comentarios.ID_usuario, comentarios.calificacion, comentarios.texto, usuarios.nombre as nombre_usuario
        FROM comentarios
        JOIN usuarios ON comentarios.ID_usuario = usuarios.ID";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $comentario = [];
        while($row = $result->fetch_object('Comentario')){
            $comentario[] = $row;
        }
       
        return $comentario;
    }

    public static function insertComentarios($userID, $id_pedido, $puntuacion, $comentario){
        $con = DataBase::connect();
        
        $stmt = $con->prepare("INSERT INTO comentarios (ID_usuario, ID_pedido, calificacion, texto) VALUES ('$userID', '$id_pedido', '$puntuacion', '$comentario')");

        $stmt->execute();
        $result = $stmt->get_result();

        $ultimoInsert = $con->insert_id;

        $stmt2 = $con->prepare("UPDATE pedidos SET ID_comentario = $ultimoInsert WHERE ID = $id_pedido");
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        return $result2;
    
    }

    public static function getComentariosByPedido($idPedido){
        $con = DataBase::connect();

        $query ="SELECT ID AS pedido_id, ID_comentario
        FROM pedidos WHERE ID = $idPedido";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();


        
        while($row = $result->fetch_assoc()){
            $pedidoId = $row['pedido_id'];
            $idComentario = $row['ID_comentario'];
            
            $tiene = $idComentario === null ? false : true;
        }

        return $tiene;
    
    }

}

?>