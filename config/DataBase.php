<?php
//Clase que hace conexion a la base de datos
class DataBase{
    public static function connect($host= 'localhost:3306', $user='administradorBBDD', $password='Informatica_1', $db='GT_Restaurante'){
        $con = new mysqli($host,$user,$password,$db);
        if($con == false){
            die('DATABASE ERROR');
        }else{
            
            return $con;
        }
    }   
}
?>