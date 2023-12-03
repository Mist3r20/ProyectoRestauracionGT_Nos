<?php
class calculadoraPrecios{
    
    public static function calculadorPrecioPedido($pedidos){
        $precioTotal = 0;
    
        foreach ($pedidos as $pedido) {
            $precioProducto = $pedido->devuelvePrecio();
            $precioProducto = str_replace('.', ',', $precioProducto);
            $precioProducto = floatval(str_replace(',', '.', $precioProducto));
            $precioTotal += $precioProducto;
        }
        
        return number_format($precioTotal, 2, '.', ',');
    }

    public static function calculaIVAPedido($pedidos){
        $ivaTotal = 0;
    
        foreach ($pedidos as $pedido) {
            $precioProducto = $pedido->devuelvePrecio();
            $precioProducto = str_replace('.', ',', $precioProducto);
            $precioProducto = floatval(str_replace(',', '.', $precioProducto));
            $ivaProducto = $precioProducto * 0.10;
            $ivaTotal += $ivaProducto;
        }
        
        return number_format($ivaTotal, 2, '.', ',');
    }
    
    public static function calculadorTotalPedido($pedidos){
        $precioTotal = 0;
        $ivaTotal = 0;
    
        foreach ($pedidos as $pedido) {
            $precioProducto = $pedido->devuelvePrecio();
            $precioProducto = str_replace('.', ',', $precioProducto);
            $precioProducto = floatval(str_replace(',', '.', $precioProducto));
            $ivaProducto = $precioProducto * 0.10;
            $precioTotal += $precioProducto;
            $ivaTotal += $ivaProducto;
        }
    
        $totalGeneral = $precioTotal + $ivaTotal;
        return number_format($totalGeneral, 2, '.', ',');
    }
}

?>