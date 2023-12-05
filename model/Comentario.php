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
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of idUser
         */ 
        public function getIdUser()
        {
                return $this->idUser;
        }

        /**
         * Set the value of idUser
         *
         * @return  self
         */ 
        public function setIdUser($idUser)
        {
                $this->idUser = $idUser;

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