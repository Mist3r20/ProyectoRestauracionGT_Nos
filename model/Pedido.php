<?php

        //Clase Pedido que tiene los productos que se añaden al carrito
    class Pedido{
        private $ID;
        private $fecha;
        private $producto;
        private $cantidad = 1;
        private $puntosUsados = 0;
        private $propinaAplicada = 0.00;
        private $porcentajeAplicado = 0;
        private $precioTotal = 0;

        public function __construct($producto){
            $this->producto = $producto;
        }

        /**
         * Get the value of producto
         */ 
        public function getProducto()
        {
                return $this->producto;
        }

        /**
         * Set the value of producto
         *
         * @return  self
         */ 
        public function setProducto($producto)
        {
                $this->producto = $producto;

                return $this;
        }

        /**
         * Get the value of cantidad
         */ 
        public function getCantidad()
        {
                return $this->cantidad;
        }

        /**
         * Set the value of cantidad
         *
         * @return  self
         */ 
        public function setCantidad($cantidad)
        {
                $this->cantidad = $cantidad;

                return $this;
        }

        public function devuelvePrecio(){
                
                return $this->producto->getPrecio()*$this->cantidad;
        }

        /**
         * Get the value of puntosUsados
         */ 
        public function getPuntosUsados()
        {
                return $this->puntosUsados;
        }

        /**
         * Set the value of puntosUsados
         *
         * @return  self
         */ 
        public function setPuntosUsados($puntosUsados)
        {
                $this->puntosUsados = $puntosUsados;

                return $this;
        }

        /**
         * Get the value of propinaAplicada
         */ 
        public function getPropinaAplicada()
        {
                return $this->propinaAplicada;
        }

        /**
         * Set the value of propinaAplicada
         *
         * @return  self
         */ 
        public function setPropinaAplicada($propinaAplicada)
        {
                $this->propinaAplicada = $propinaAplicada;

                return $this;
        }

        /**
         * Get the value of porcentajeAplicado
         */ 
        public function getPorcentajeAplicado()
        {
                return $this->porcentajeAplicado;
        }

        /**
         * Set the value of porcentajeAplicado
         *
         * @return  self
         */ 
        public function setPorcentajeAplicado($porcentajeAplicado)
        {
                $this->porcentajeAplicado = $porcentajeAplicado;

                return $this;
        }

        /**
         * Get the value of ID
         */ 
        public function getID()
        {
                return $this->ID;
        }

        /**
         * Set the value of ID
         *
         * @return  self
         */ 
        public function setID($ID)
        {
                $this->ID = $ID;

                return $this;
        }

        /**
         * Get the value of fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Get the value of precioTotal
         */ 
        public function getPrecioTotal()
        {
                return $this->precioTotal;
        }

        /**
         * Set the value of precioTotal
         *
         * @return  self
         */ 
        public function setPrecioTotal($precioTotal)
        {
                $this->precioTotal = $precioTotal;

                return $this;
        }
    }
?>