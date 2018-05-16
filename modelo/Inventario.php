<?php
/**
 * Description of Inventario
 *
 * @author migue
 */
class Inventario {
    
    private $array_estanteriaCajas = array();
    private $fecha_inv;
    
    // Contructor 
    public function __construct($array_estanteriaCajas) {
        $this->array_estanteriaCajas = $array_estanteriaCajas;
        $this->fecha_inv = date("Y-m-d"); // Ponemos por defecto la fecha actual
    }

    // Set y Get

    public function setarray_estanteriaCajas($array_estanteriaCajas) {
        $this->array_cajas = $array_estanteriaCajas;
    }

    public function setFecha_inv($fecha_inv) {
        $this->fecha_inv = $fecha_inv;
    }

    public function getarray_estanteriaCajas() {
        return $this->array_estanteriaCajas;
    }

    public function getFecha_inv() {
        return $this->fecha_inv;
    }

    // toString
    public function __toString() {
        
    }

}
