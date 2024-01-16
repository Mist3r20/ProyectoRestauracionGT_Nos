<?php
include_once 'Comentarios.php';

//Clase comentario que hereda valores de Comentarios
class Comentario extends Comentarios{

    public function __construct(){
    
    }


    
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->ID;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($ID)
        {
                $this->ID = $ID;

                return $this;
        }

        /**
         * Get the value of idUser
         */ 
        public function getIdUser()
        {
                return $this->nombre_usuario;
        }

        /**
         * Set the value of idUser
         *
         * @return  self
         */ 
        public function setIdUser($nombre_usuario)
        {
                $this->nombre_usuario = $nombre_usuario;

                return $this;
        }

        /**
         * Get the value of estrellas
         */ 
        public function getEstrellas()
        {
                return $this->calificacion;
        }

        /**
         * Set the value of estrellas
         *
         * @return  self
         */ 
        public function setEstrellas($calificacion)
        {
                $this->calificacion = $calificacion;

                return $this;
        }

        /**
         * Get the value of texto
         */ 
        public function getTexto()
        {
                return $this->texto;
        }

        /**
         * Set the value of texto
         *
         * @return  self
         */ 
        public function setTexto($texto)
        {
                $this->texto = $texto;

                return $this;
        }
}

?>