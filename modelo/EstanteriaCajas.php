<?php

/**
 * Description of EstanteriasCajas
 *
 * @author migue
 */
include 'Estanteria.php';
class EstanteriaCajas extends Estanteria{
    
    private $array_caja = array();
    
    // Constructor
    
    public function __construct($estanteria, $array_caja) {
        parent::__construct($estanteria->getCodigo(), $estanteria->getMaterial(), $estanteria->getN_lejas(), $estanteria->getPasillo(), $estanteria->getN_pasillo());
        parent::setLejas_ocupadas($estanteria->getLejas_ocupadas());
        $this->array_caja = $array_caja;
    }
    
    // Set y Get
    
    public function setArray_caja($array_caja) {
        $this->array_caja = $array_caja;
    }

    public function getArray_caja() {
        return $this->array_caja;
    }

    // toString
    
    public function __toString() {
        $cadena = parent::__toString()
                . "Cajas: " . $this->array_caja;
        return $cadena;    
    }
}