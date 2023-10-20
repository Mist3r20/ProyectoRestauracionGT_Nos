<?php

class DataBase{
    public static function connect($host= 'localhost', $user='root', $password='', $db='gt_bbdd'){
        $con = new mysqli($host,$user,$password,$db);
        if($con == false){
            die('DATABASE ERROR');
        }else{
            
            return $con;
        }
    }   
}
?>