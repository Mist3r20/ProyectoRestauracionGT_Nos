<?php
include_once 'model/Bebidas.php';
include_once 'model/Mariscos.php';
include_once 'model/Pizzas.php';
include_once 'model/Postres.php';
include_once 'model/Sandwiches.php';
include_once 'model/Principales.php';
include_once 'model/Entrantes.php';
include_once 'model/ProductoDAO.php';
include_once 'model/Pedido.php';
include_once 'utils/CalculadoraPrecio.php';
include_once 'model/Comentario.php';

//Realizamos include de este archivo para comprobar si esta iniciada o no la session
include 'utils/session_init.php';


class comentariosController{
    public function comentarios(){
        $nombre = "Comentarios";

        include_once 'views/header.php';
        include_once 'views/comentarios.php';
        include_once 'views/footer.php';
    }

    public function FormularioComentarios(){
        if(isset($_SESSION['ID'])){
            $nombre = "Nuevo Comentario";
            $id_pedido = $_POST['addComentario'];
            var_dump($id_pedido);

            include_once 'views/header.php';
            include_once 'views/formularioComentarios.php';
            include_once 'views/footer.php'; 
        }else{
            header("Location:".url.'?controller=usuario&action=session');
        }
        
    }
}
?>