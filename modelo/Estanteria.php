<?php
/**
 * Description of Estanteria
 *
 * @author migue
 */
class Estanteria {

    private $id;
    private $codigo;
    private $material;
    private $n_lejas;
    private $pasillo;
    private $n_pasillo;
    private $lejas_ocupadas;

    // Contructor

    public function __construct($codigo, $material, $n_lejas, $pasillo, $n_pasillo) {
        $this->codigo = $codigo;
        $this->material = $material;
        $this->n_lejas = $n_lejas;
        $this->pasillo = $pasillo;
        $this->n_pasillo = $n_pasillo;
        $this->lejas_ocupadas = 0;
    }

    // Set y Get

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setMaterial($material) {
        $this->material = $material;
    }

    public function setN_lejas($n_lejas) {
        $this->n_lejas = $n_lejas;
    }

    public function setPasillo($pasillo) {
        $this->pasillo = $pasillo;
    }

    public function setN_pasillo($n_pasillo) {
        $this->n_pasillo = $n_pasillo;
    }

    public function setLejas_ocupadas($lejas_ocupadas) {
        $this->lejas_ocupadas = $lejas_ocupadas;
    }

    public function getId() {
        return $this->id;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function getN_lejas() {
        return $this->n_lejas;
    }

    public function getPasillo() {
        return $this->pasillo;
    }

    public function getN_pasillo() {
        return $this->n_pasillo;
    }

    public function getLejas_ocupadas() {
        return $this->lejas_ocupadas;
    }

    // To String

    public function __toString() {
        return "Estanteria" . "<br>"
                . "Id: " . $this->id
                . " Código: " . $this->codigo
                . " Material: " . $this->material
                . " Nº Lejas: " . $this->n_lejas
                . " Pasillo: " . $this->pasillo
                . " Nº Pasillo: " . $this->n_pasillo
                . " Lejas Ocupadas: " . $this->lejas_ocupadas;
    }

}