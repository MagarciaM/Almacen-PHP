<?php

/**
 * Description of CajaBackup
 *
 * @author migue
 */
include 'CajaPosicion.php';
class CajaBackup extends CajaPosicion{
    
    private $fecha_salida;
    private $cod_estanteria;
    
    // Contructor
    public function __construct($cajaPosicion, $cod_estanteria) {
        parent::__construct($cajaPosicion, $cajaPosicion->getLeja());
        $this->cod_estanteria = $cod_estanteria;
    }

    // Set y Get
    public function setCod_estanteria($cod_estanteria) {
        $this->cod_estanteria = $cod_estanteria;
    }
    
    public function setFecha_salida($fecha_salida) {
        $this->fecha_salida = $fecha_salida;
    }

    public function getCod_estanteria() {
        return $this->cod_estanteria;
    }
    
    public function getFecha_salida() {
        return $this->fecha_salida;
    }

    //toString
    public function _toString() {
        $cadena =  parent::_toString()
                . "Cod Estanteria: " . $this->leja
                . "Fecha Salida: " . $this->fecha_salida;
        return $cadena;
    }
}
