<?php
include_once 'model/ProductoDAO.php';
//Cargar modelos necesarios


class APIController{
    public function api(){
        
        if($_POST["accion"] == 'buscar_review'){
            $comentarios = ProductoDAO::getComentariosPrincipal();

            // Transformar objetos Comentario a arrays asociativos
            $comentariosArray = [];
            foreach ($comentarios as $comentario) {
                $comentariosArray[] = [
                    'ID' => $comentario->getID(),
                    'ID_usuario' => $comentario->getIdUser(),
                    'calificacion' => $comentario->getEstrellas(),
                    'texto' => $comentario->getTexto(),
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($comentariosArray, JSON_UNESCAPED_UNICODE);
            return;
            
        }
    
    }
}


?>