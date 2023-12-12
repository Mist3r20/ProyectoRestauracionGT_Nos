<?php

//Clase abstracta Usuario que tendra las variables y valores necesarios
abstract class Usuario{
    protected $ID;
    protected $Nombre;
    protected $Apellido;
    protected $email;
    protected $password;
    protected $rol = "Basico";



    public function __construct($ID, $Nombre, $Apellido, $email, $password, $rol){
        $this->ID=$ID;
        $this->Nombre=$Nombre;
        $this->Apellido=$Apellido;
        $this->email=$email;
        $this->password=$password;
        $this->rol=$rol;
    
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
     * Get the value of Nombre
     */ 
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @return  self
     */ 
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get the value of Apellido
     */ 
    public function getApellido()
    {
        return $this->Apellido;
    }

    /**
     * Set the value of Apellido
     *
     * @return  self
     */ 
    public function setApellido($Apellido)
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of contraseña
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of contraseña
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
}


?>