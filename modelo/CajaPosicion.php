<?php

/**
 * Description of CajaPosicion
 *
 * @author migue
 */
include 'Caja.php';
class CajaPosicion extends Caja{ // Una clase que es una caja con position
    
    private $leja;
    
    // Contructor
    
    public function __construct($caja, $leja) {
        parent::__construct($caja->getCodigo(), $caja->getAltura(), $caja->getAnchura(), $caja->getProfundidad(), $caja->getColor(), $caja->getMaterial(), $caja->getContenido());
        $this->leja = $leja;
        parent::setId($caja->getId()); // Pasamos el id por set ya que no esta en el contructor
        parent::setFecha_alta($caja->getFecha_alta()); // Usamos la fecha que nos da la caja que nos mandan
    }
    
    // Set y Get
    
    public function setLeja($leja) {
        $this->leja = $leja;
    }

    public function getLeja() {
        return $this->leja;
    }

    // toString
    public function _toString() {
        $cadena =  parent::_toString()
                . "Leja: " . $this->leja;
        return $cadena;
    }

}
