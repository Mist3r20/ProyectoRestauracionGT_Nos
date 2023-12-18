<?php
include_once 'Producto.php';

//Clase Bebidas que hereda los valores de Producto
class Bebidas extends Producto{

    protected $ml = 0;

    public function __construct(){
    }

    // public function __construct($ID, $Nombre, $precio,$descripcion, $nombre_categoria, $foto, $ml){
    //     parent::__construct($ID, $Nombre, $precio,$descripcion, $nombre_categoria, $foto);
    //     $this->ml=$ml;
    // }


    // /**
    //  * Get the value of ml
    //  */ 
    // public function getMl()
    // {
    //     return $this->ml;
    // }

    // /**
    //  * Set the value of ml
    //  *
    //  * @return  self
    //  */ 
    // public function setMl($ml)
    // {
    //     $this->ml = $ml;

    //     return $this;
    // }
}
?>