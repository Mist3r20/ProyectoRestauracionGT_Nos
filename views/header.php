<?php
//Comprobaremos si hay usuario registrado para mostrar uno u otro header
include 'utils/session_init.php';

if(isset($_SESSION['ID'])){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "Basico"){
        $datosLink = '<a class="linkheader" href="?controller=usuario&action=datos">Ver Datos</a>';
    } elseif(isset($_SESSION['rol']) && $_SESSION['rol'] === "Administrador"){
        $datosLink = '<a class="linkheader" href="?controller=usuario&action=datos">Ver Datos</a>';
        $adminPanelLink = '<a class="linkheader" href="?controller=usuario&action=panel">Panel de Administrador</a>';
    }

    include 'header2.php';

}else{
    include 'header1.php';
}
if(!isset($_SESSION['selecciones'])){
    $_SESSION['selecciones'] = array();
}


?>