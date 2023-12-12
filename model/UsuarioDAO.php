<?php

include_once 'config/DataBase.php';
include_once 'model/Administrador.php';
include_once 'model/Basico.php';

//Clase que tratara las funciones relacionadas con el usuario con SQL

class UsuarioDAO{
    //Funcion que buscara en la base de datos el usuario 
    public static function getUsuario($email){
        $con = DataBase::connect();

        $query = "SELECT usuarios.rol FROM usuarios WHERE email = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $tipo = $stmt->get_result()->fetch_object()->rol;

        $query ="SELECT usuarios.ID, usuarios.Nombre, usuarios.Apellido, usuarios.email, usuarios.password, usuarios.rol
        FROM usuarios WHERE email = ?;";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();

        while($row = $result->fetch_object($tipo)){
            $usuarios[] = $row;
        }

        

        return $usuarios;
    }

    public static function insertUsuario($nombre, $apellido, $email, $password){
        $con = DataBase::connect();

        $query = "INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES ('$nombre', '$apellido','$email','$password', 'Basico')";
        $stmt = $con->prepare($query);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result;
    } 

    
}

?>