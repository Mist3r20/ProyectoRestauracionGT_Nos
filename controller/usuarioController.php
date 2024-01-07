<?php

include_once 'model/Administrador.php';
include_once 'model/Basico.php';
include_once 'model/UsuarioDAO.php';
include_once 'model/Usuario.php';
//Clase que controlara todo lo relacionado con los usuarios
class usuarioController{
    //Funcion que contiene el incio y registro de una session de usuario
    public function session(){
        $nombre = "Iniciar Session";
    
        include_once 'views/header.php';
        include_once 'views/session.php';
    }

    public function iniciar(){
        //Inicio de sesion
        if(isset($_POST['email'], $_POST['password'])){
            $email = $_POST['email'];
            $contra = $_POST['password'];
            
            $usuarios = UsuarioDAO::getUsuario($email);
            
            if(!$usuarios){
                echo("ERROR: No se ha encontrado ningun usuario");
            }else{
                foreach($usuarios as $usuario){
                    $DBcontra = $usuario->getPassword();
                    if(password_verify($contra, $DBcontra)){
                        session_start();
                        $_SESSION['ID']=$usuario->getID();
                        $_SESSION['rol']=$usuario->getRol();
                        header("Location:".url.'?controller=producto&action=index');
                        
                    }else{
                        echo("ERROR: Email o Contraseña Incorrectas");
                    }
                }
                
            }


        }
    }

    //Funcion para hacer el registro del usuario nuevo
    public function registro(){
        if(isset($_POST['username'], $_POST['apellido'], $_POST['email'], $_POST['password'], $_POST['passwordRepetir'])){
            if($_POST['password'] == $_POST['passwordRepetir']){
                $nombre= $_POST['username'];
                $apellido = $_POST['apellido'];
                $email = $_POST['email'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                //Ciframos la contraseña3
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $resultadoInsert = UsuarioDAO::insertUsuario($nombre, $apellido, $email, $direccion, $telefono, $password);
                //Redirigimos a la pagina principal
                header("Location:".url.'?controller=producto');
                
            }
        }
    }

    public function cerrarSession(){
        //Este script destruye todos los datos de session del usuario por lo que se usa para cerrar session
        session_start();
        session_destroy();
        header("Location:".url.'?controller=producto&action=index');
    
    }

    //Funcion para mostrar los datos del usuario
    public function datos(){
        $nombre = "Datos personales";

        //buscamos el usuario en la base de datos
        $id = $_SESSION['ID'];
        $users = UsuarioDAO::getUsuarioById($id);
        
        include_once 'views/header.php';
        include_once 'views/datosUser.php';
        include_once 'views/footer.php';
    
    }

    //Funcion que permitira que el usuario actualice sus datos 
    public function actualizar(){
        $id = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        if($_POST['password'] === ""){
            $contra = $_POST['contraseña_usuario'];
        }else{
            $contra = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
        

        //Enviamos los datos para hacer el update
        UsuarioDAO::updateUsuario($id, $nombre, $apellido, $email, $direccion, $telefono, $contra);
        header("Location:".url.'?controller=usuario&action=datos');

    }


    //Funcion para que el administrador pueda administrar la pagina web
    public function panel(){

        $nombre = "Panel de Administrador";
    
        $allProducts = ProductoDAO::getAllProducts();

        include_once 'views/header.php';
        include_once 'views/panelAdmin.php';
        include_once 'views/footer.php';
    
    
    }
}
?>