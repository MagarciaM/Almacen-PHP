<?php
/**
 * Description of Ocupacion
 *
 * @author migue
 */
class Ocupacion {
    
    private $caja;
    private $cod_estanteria;
    private $leja;
    
    // Constructor 
    public function __construct($caja, $cod_estanteria, $leja) {
        $this->caja = $caja;
        $this->cod_estanteria = $cod_estanteria;
        $this->leja = $leja;
    }
    
    // Set y Get
    
    public function setCaja($caja) {
        $this->caja = $caja;
    }

    public function setCod_estanteria($cod_estanteria) {
        $this->cod_estanteria = $cod_estanteria;
    }

    public function setLeja($leja) {
        $this->leja = $leja;
    }

    public function getCaja() {
        return $this->caja;
    }

    public function getCod_estanteria() {
        return $this->cod_estanteria;
    }

    public function getLeja() {
        return $this->leja;
    }

    // toString
    
    public function __toString() {
        
    }

}
