<?php

/**
 * Description of Usuario
 *
 * @author migue
 */
class Usuario {
    
    private $nombre;
    private $pass;
    
    // Constructor
    public function __construct($nombre, $pass) {
        $this->nombre = $nombre;
        $this->pass = $pass;
    }
    
    // Set Y Get
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPass() {
        return $this->pass;
    }

    // to_String
    public function __toString() {
        return "Nombre: " . $this->nombre . "Pass: " . $this->pass;
    }


            
}
