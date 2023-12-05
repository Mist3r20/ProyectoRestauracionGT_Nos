<?php
include_once 'Producto.php';

//Clase entrantes que hereda de Producto
class Entrantes extends Producto{

    public function __construct(){
        
        
    }

    /**public function calculaPrecioTotal($numDias){
        $precioTotal = $numDias * self::PRECIOENTRANTE;
        return $precioTotal;
    }

    public function devuelvePrecioDia(){
        return self::PRECIOENTRANTE;
    }*/
}
?>