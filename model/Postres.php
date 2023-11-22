<?php
include_once 'Producto.php';


class Postres extends Producto{

    public function __construct(){
        
    }

    
    /**public function calculaPrecioTotal($numDias){
        $precioTotal = $numDias * self::PRECIOBEBIDA;
        return $precioTotal;
    }

    public function devuelvePrecioDia(){
        return self::PRECIOBEBIDA;
    }*/
}
?>