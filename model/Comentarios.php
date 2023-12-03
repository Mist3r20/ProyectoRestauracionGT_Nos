<?php


    abstract class Comentarios{

        protected $id;
        protected $idUser;
        protected $calificacion;
        protected $texto;

        public function __construct($id, $idUser, $calificacion, $texto){
            $this->id = $id;
            $this->idUser = $idUser;
            $this->calificacion = $calificacion;
            $this->texto = $texto;
        }
    
        

    }

?>