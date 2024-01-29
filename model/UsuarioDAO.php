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

        $query ="SELECT usuarios.ID, usuarios.Nombre, usuarios.Apellido, usuarios.email, usuarios.direccion, usuarios.telefono, usuarios.password, usuarios.rol, fidelidad.puntos
        FROM usuarios
        LEFT JOIN fidelidad ON usuarios.ID = fidelidad.ID_usuario
        WHERE usuarios.email = ?;";

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

    //Funcion para insertar en la base de datos el nuevo usuario
    public static function insertUsuario($nombre, $apellido, $email, $direccion, $telefono, $password){
        $con = DataBase::connect();

        $query = "INSERT INTO usuarios (nombre, apellido, email, direccion, telefono, password, rol) VALUES ('$nombre', '$apellido','$email','$direccion', '$telefono', '$password', 'Basico')";
        $stmt = $con->prepare($query);
        $stmt->execute();
        
        $result = $stmt->get_result();

        $id_user = $con->insert_id;

        $query2 = "INSERT INTO fidelidad (ID_usuario, puntos) VALUES ('$id_user', 0);";
        $stmt2 = $con->prepare($query2);
        $stmt2->execute();
        
        $result = $stmt->get_result();
        return $result;
    }

    //Funcion para buscar un usuario por su ID
    public static function getUsuarioById($id){
        
        $con = DataBase::connect();

        $query = "SELECT usuarios.rol FROM usuarios WHERE ID = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $tipo = $stmt->get_result()->fetch_object()->rol;

        $query ="SELECT usuarios.ID, usuarios.Nombre, usuarios.Apellido, usuarios.email, usuarios.direccion, usuarios.telefono, usuarios.password, usuarios.rol, fidelidad.puntos
        FROM usuarios
        LEFT JOIN fidelidad ON usuarios.ID = fidelidad.ID_usuario
        WHERE usuarios.ID = ?;
        ";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $con->close();

        while($row = $result->fetch_object($tipo)){
            $user[] = $row;
        }

        return $user;
    
    }

    //Funcion para actualizar a un usuario en la BBDD
    public static function updateUsuario($id, $nombre, $apellido, $email, $direccion, $telefono, $contra){
        
        $con = DataBase::connect();

        $query = "UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, direccion = ?, telefono= ?, password = ? WHERE ID = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssssisi", $nombre, $apellido, $email, $direccion, $telefono, $contra, $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }


    public static function obtenerPuntosDisponiblesUsuario($idUser){
        $con = DataBase::connect();
    
        $query = "SELECT puntos FROM fidelidad WHERE ID_usuario = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Realizar fetch_assoc para obtener la fila asociativa
        $puntosDisponiblesRow = $result->fetch_assoc();
    
        // Extraer el valor de la fila
        $puntosDisponibles = $puntosDisponiblesRow['puntos'];
    
        // Cerrar la conexión y devolver el valor
        $stmt->close();
    
        return $puntosDisponibles;
    }

    public static function actualizarPuntos($idUser, $puntosNew){
        $con = DataBase::connect();

        $query = "UPDATE fidelidad SET puntos = ? WHERE ID_usuario = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ii", $puntosNew, $idUser);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result;
    }
    
    
}

?>