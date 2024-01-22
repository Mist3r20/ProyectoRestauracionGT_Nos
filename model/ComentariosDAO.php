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

    public static function insertComentarios($userID, $comentario, $puntuacion){
        $con = DataBase::connect();
        
        $stmt = $con->prepare("INSERT INTO comentarios ('ID_usuario', 'calificacion', 'texto') VALUES ('$userID', '$puntuacion', '$comentario')");

        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    
    }

}

?>