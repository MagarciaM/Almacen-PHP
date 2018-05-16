<?php
/**
 * Description of Caja
 *
 * @author migue
 */
class Caja {
    
    private $id;
    private $codigo;
    private $altura;
    private $anchura;
    private $profundidad;
    private $color;
    private $material;
    private $contenido;
    private $fecha_alta;
    
    // Contructor 
    
    public function __construct($codigo, $altura, $anchura, $profuncidad, $color, $material, $contenido) {
        $this->codigo = $codigo;
        $this->altura = $altura;
        $this->anchura = $anchura;
        $this->profundidad = $profuncidad;
        $this->color = $color;
        $this->material = $material;
        $this->contenido = $contenido;
        $this->fecha_alta = date("Y-m-d"); // Ponemos por defecto la fecha actual al lata de caja
    }
    
    // Set y Get
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setAltura($altura) {
        $this->altura = $altura;
    }

    public function setAnchura($anchura) {
        $this->anchura = $anchura;
    }

    public function setProfundidad($profuncidad) {
        $this->profundidad = $profuncidad;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setMaterial($material) {
        $this->material = $material;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }
    public function setFecha_alta($fecha_alta) {
        $this->fecha_alta = $fecha_alta;
    }

    public function getId() {
        return $this->id;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getAltura() {
        return $this->altura;
    }

    public function getAnchura() {
        return $this->anchura;
    }

    public function getProfundidad() {
        return $this->profundidad;
    }

    public function getColor() {
        return $this->color;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function getContenido() {
        return $this->contenido;
    }
    
    public function getFecha_alta() {
        return $this->fecha_alta;
    }

    // ToString
    
    public function _toString() {
        $cadena = " Caja: " . "<br>"
                . "Cod: " . $this->codigo
                . "Altura: " . $this->altura
                . "Anchura: " . $this->anchura
                . "Profuncidad: " . $this->profuncidad
                . "Color: " . $this->color
                . "Material: " . $this->material
                . "Contenido: " . $this->contenido;    
        return $cadena;    
    }

}