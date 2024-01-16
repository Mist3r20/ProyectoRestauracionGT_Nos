<?php

    //Clase abtracta y padre de Comentarios que tiene los valores que tiene un comentario en la base de datos
    abstract class Comentarios{

        protected $ID;
        protected $nombre_usuario;
        protected $calificacion;
        protected $texto;

        public function __construct($ID, $nombre_usuario, $calificacion, $texto){
            $this->ID = $ID;
            $this->nombre_usuario = $nombre_usuario;
            $this->calificacion = $calificacion;
            $this->texto = $texto;
        }
    
        

    }

?>