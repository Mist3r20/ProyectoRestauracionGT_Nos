<?php
include_once 'model/ProductoDAO.php';
include_once 'model/ComentariosDAO.php';
//Cargar modelos necesarios

//Realizamos include de este archivo para comprobar si esta iniciada o no la session
include 'utils/session_init.php';


class APIController{
    public function api(){
        
        if($_POST["accion"] == 'buscar_review'){
            $comentarios = ComentariosDAO::getComentarios();

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
            $puntuacion = $_POST['puntuacion'];
            $id_pedido = $_POST['idPedido'];
            $insertarCom = ComentariosDAO::insertComentarios($userID, $id_pedido, $puntuacion, $comentario);

            echo json_encode($insertarCom, JSON_UNESCAPED_UNICODE);

        }elseif($_POST["accion"] == 'mostrarBoton'){
            $idPedido = $_POST["id"]; 
            $tieneComentario = ComentariosDAO::getComentariosByPedido($idPedido);
            

            echo json_encode($tieneComentario, JSON_UNESCAPED_UNICODE);
            return;
        }elseif($_POST["accion"] == 'mostrarPuntos'){
            $idUser = $_SESSION["ID"];
            $puntos = UsuarioDAO::obtenerPuntosDisponiblesUsuario($idUser);

            echo json_encode($puntos, JSON_UNESCAPED_UNICODE);
            return;
        }
      
    }
}


?>