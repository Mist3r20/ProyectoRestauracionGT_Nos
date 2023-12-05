<?php
//Clase Producto padre que tiene las variables y valores necesarios de un producto en la base de datos
abstract class Producto{
    
    protected $ID;
    protected $Nombre;
    protected $precio;
    protected $descripcion;
    protected $nombreCategoria;
    protected $foto;

    public function __construct($ID, $Nombre, $precio,$descripcion, $nombre_categoria, $foto){
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->nombreCategoria = $nombre_categoria;
        $this->foto = $foto;
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
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->Nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    

    /**
     * Get the value of foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of nombre_categoria
     */ 
    public function getNombre_categoria()
    {
        return $this->nombreCategoria;
    }

    /**
     * Set the value of nombre_categoria
     *
     * @return  self
     */ 
    public function setNombre_categoria($nombre_categoria)
    {
        $this->nombreCategoria = $nombre_categoria;

        return $this;
    }
}
?>