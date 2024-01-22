<?php
include_once 'model/ProductoDAO.php';
include_once 'model/ComentariosDAO.php';
//Cargar modelos necesarios


class APIController{
    public function api(){
        print_r($_POST);
        if($_POST["accion"] == 'buscar_review'){
            $comentarios = ComentariosDAO::getComentariosPrincipal();

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

            echo json_encode($comentariosArray, JSON_UNESCAPED_UNICODE);
            return;
            
        }elseif($_POST["accion"] == 'agregarComentario'){
            
            
            $userID = $_SESSION['ID'];
            $comentario = $_POST['comentario'];
            $puntuacion = $_POST['$puntuacion'];
            $insertarCom = ComentariosDAO::insertComentarios($userID, $comentario, $puntuacion);
            return;
        }
      
    }
}


?>