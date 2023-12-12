<?php
//Comprobaremos si hay usuario registrado para mostrar uno u otro header
include 'utils/session_init.php';

if(isset($_SESSION['ID'])){
    include 'header2.php';
}else{
    include 'header1.php';
}
if(!isset($_SESSION['selecciones'])){
    $_SESSION['selecciones'] = array();
}


?>